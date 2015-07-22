<?php
    use Code2be\Model\UserQuery;
    use Code2be\Model\User;
    use Code2be\Helper\Form;
    use Code2be\Helper\Voter;

    $app->get('/users', function() use ($app) {
        $users = UserQuery::create()
            ->orderByLastName()
            ->find();
        echo $app->view->render(
            'users.html.twig',
            ['users'=>$users, 'active' => 'users']
        );
    })->name('users');

    $app->get('/user(/:id)', function($id = null) use ($app) {
        if (is_null($id)) {
            $user = new User();
        } else {
            $user = UserQuery::create()
                ->findPk($id);
            if (is_null($user)) {
                $app->notFound();
            }
        }

        echo $app->view->render(
            'user.html.twig',
            [
                'user'=>$user,
                'roles' => \Code2be\Helper\Auth::getAvailableRoles(),
                'active' => 'users',
                'errors' => [],
            ]
        );
    })->name('user');

    $app->post('/user', function() use ($app) {
        if (!Voter::isGranted(['ROLE_PRESIDENT', 'ROLE_TREASURER'])) {
            $app->halt(403, 'Not enough rights !');
        }

        $post = $app->request->post();
        $user = UserQuery::findOrCreate($post['id']);
        if (is_null($user)) {
            $app->notFound();
        }
        Form::handleRequest($post, $user);
        $errors = [];
        if ($user->validate()) {
            if (isset($post['generatePassword']) && !empty($post['generatePassword'])) {
                \Code2be\Helper\Auth::generatePassword($user);
            }
            $user->save();
            $app->flash('success', 'Membre sauvegardé avec succès');
            $app->redirect('/user/'.$user->getId());
        } else {
            $app->flashNow('error', 'Echec de la sauvegarde');
            foreach ($user->getValidationFailures() as $failure) {
                $errors[$failure->getColumn()] = $failure->getMessage();
            }
            echo $app->view->render(
                'user.html.twig',
                [
                    'user'=>$user,
                    'roles' => \Code2be\Helper\Auth::getAvailableRoles(),
                    'active' => 'users',
                    'errors' => $errors
                ]
            );
        }
    })->name('user_post');


    $app->get('/me', function() use ($app) {
        $user = \Code2be\Helper\Auth::getUser();
        if (!$user instanceof User) {
            $app->notFound();
        }

        echo $app->view->render(
            'me.html.twig',
            [
                'user'=>$user,
                'active' => 'profile',
                'errors' => [],
            ]
        );


    })->name('me');

    $app->post('/me', function() use ($app) {
        $post = $app->request->post();
        $user = UserQuery::findOrCreate($post['id']);
        if (is_null($user)) {
            $app->notFound();
        }

        $userConnect = \Code2be\Helper\Auth::getUser();
        if ($userConnect->getId() != $user->getId()) {
            $app->halt(403, 'Not enough rights !');
        }

        if (empty($post['password'])) {
            unset($post['password']);
        } else {
            $post['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
        }

        $currentPassword = $user->getPassword();

        Form::handleRequest($post, $user);

        $errors = [];
        // Special case for password

        if (
            (!empty($post['currentPassword']) || !empty($post['password'])) &&
            !password_verify($post['currentPassword'], $currentPassword)
        ) {
            $errors['user.current_password'] = 'Mauvais mot de passe';
        }

        if (
            !empty($post['password']) &&
            !password_verify($post['rePassword'], $post['password'])
        ) {
            $errors['user.re_password'] = 'Les saisies sont différentes';
        }

        if ($user->validate() && empty($errors)) {
            $user->save();
            \Code2be\Helper\Auth::updateUser($user);
            $app->flash('success', 'Profile mis à jour avec succès');
            $app->redirect('/me');
        } else {
            $app->flashNow('error', 'Echec de la sauvegarde');
            foreach ($user->getValidationFailures() as $failure) {
                $errors[$failure->getColumn()] = $failure->getMessage();
            }
            echo $app->view->render(
                'me.html.twig',
                [
                    'user'=>$user,
                    'roles' => \Code2be\Helper\Auth::getAvailableRoles(),
                    'active' => 'profile',
                    'errors' => $errors
                ]
            );
        }
    })->name('me_post');
