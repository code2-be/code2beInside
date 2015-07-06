<?php
    use Code2be\Model\UserQuery;
    use Code2be\Model\User;
    use Code2be\Helper\Form;

    $app->get('/', function() use ($app) {
        echo $app->view->render('homepage.html.twig', ['active' => 'homepage']);
    })->name('homepage');

    $app->get('/login', function() use ($app) {
        echo $app->view->render('login.html.twig', ['active' => 'homepage']);
    })->name('login');

    $app->get('/logout', function() use ($app) {
        \Code2be\Helper\Auth::logout();
        $app->redirect('/');
    })->name('logout');

    $app->post('/login', function() use ($app) {
        $post = $app->request->post();
        if (!\Code2be\Helper\Auth::login($post)) {
            $app->flash('error', 'Mauvais login ou mot de passe');
        }
        $app->redirect('/');
    })->name('login_post');

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
            ['user'=>$user, 'active' => 'users']
        );
    })->name('user');

    $app->post('/user', function() use ($app) {
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
            foreach ($user->getValidationFailures() as $failure) {
                $app->flashNow('error', 'Echec de la sauvegarde');
                $errors[$failure->getPropertyPath()] = $failure->getMessage();
            }
            echo $app->view->render(
                'user.html.twig',
                ['user'=>$user, 'active' => 'users', 'errors' => $errors]
            );
        }
    })->name('user_post');

    $app->get('/ideabox', function() use ($app) {
        echo $app->view->render('ideaBox.html.twig', ['active' => 'ideaBox']);
    })->name('ideaBox');

    $app->get('/accounting/incoming', function() use ($app) {
        echo $app->view->render(
            'accounting.html.twig',
            ['type' => 'incoming', 'active' => 'accounting']
        );
    })->name('incomingAccounting');

    $app->get('/accounting/outgoing', function() use ($app) {
        echo $app->view->render(
            'accounting.html.twig',
            ['type' => 'outgoing', 'active' => 'accounting']
        );
    })->name('outgoingAccounting');

?>
