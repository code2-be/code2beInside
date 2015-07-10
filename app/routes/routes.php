<?php
    $app->get('/', function() use ($app) {
        echo $app->view->render('homepage.html.twig', ['active' => 'homepage']);
    })->name('homepage');

    require_once __ROOT__.'/app/routes/security.php';
    require_once __ROOT__.'/app/routes/users.php';


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
