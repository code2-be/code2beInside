<?php
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

