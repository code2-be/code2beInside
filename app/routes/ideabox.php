<?php

use Code2be\Model\ThreadQuery;
use Code2be\Model\Thread;
use Code2be\Helper\Form;
use Code2be\Model\PostQuery;
use Code2be\Model\Post;

    $app->get('/ideabox', function() use ($app) {
        $threads = ThreadQuery::create()
            ->orderByUpdatedAt('desc')
            ->find();

        echo $app->view->render('ideaBox.html.twig',
            [
                'active' => 'ideaBox',
                'threads' => $threads,
            ]
        );
    })->name('ideaBox');

    $app->get('/thread(/:id)', function($id = null) use ($app) {
        if (is_null($id)) {
            $thread = new Thread();
        } else {
            $thread = ThreadQuery::create()
                ->findPk($id);
            if (is_null($thread)) {
                $app->notFound();
            }
        }

        echo $app->view->render('thread.html.twig',
            [
                'active' => 'ideaBox',
                'thread' => $thread,
                'errors' => [],
            ]
        );
    })->name('thread');

    $app->post('/thread', function() use ($app) {
        $post = $app->request->post();
        $thread = ThreadQuery::findOrCreate($post['id']);
        if (is_null($thread)) {
            $app->notFound();
        }
        Form::handleRequest($post, $thread);
        $errors = [];
        if ($thread->validate()) {
            $thread->save();
            $app->flash('success', 'Sujet sauvegardé avec succès');
            $app->redirect('/ideabox');
        } else {
            $app->flashNow('error', 'Echec de la sauvegarde');
            foreach ($thread->getValidationFailures() as $failure) {
                $errors[$failure->getColumn()] = $failure->getMessage();
            }
            echo $app->view->render(
                'thread.html.twig',
                [
                    'thread'=>$thread,
                    'active' => 'ideaBox',
                    'errors' => $errors
                ]
            );
        }
    })->name('thread_post');


    $app->get('/posts(/:id)', function($threadId = null) use ($app) {
        $thread = ThreadQuery::findOrCreate($threadId);
        if (!is_null($threadId)) {
            $posts  = PostQuery::create()
                ->orderByUpdatedAt('desc')
                ->findTree($threadId);
        } else {
            $posts = [];
        }

        echo $app->view->render(
            'posts.html.twig',
            [
                'thread' => $thread,
                'posts'  => $posts,
                'post'   => new Post,
                'active' => 'ideaBox',
                'errors' => [],
            ]
        );

    })->name('posts');

    $app->post('/post', function() use ($app) {
        $post = $app->request->post();
        $thread = ThreadQuery::findOrCreate($post['threadId']);
        if (is_null($thread)) {
            $app->notFound();
        }
        $postObject = new Post;
        Form::handleRequest($post, $postObject);
        $errors = [];
        if ($postObject->validate()) {
            // TODO : Cleanup this code...
            $postObject->getThread()->setUpdatedAt(time());
            $postObject->save();
            $app->flash('success', 'Commentaire sauvegardé avec succès');
            $app->redirect('/posts/'.$postObject->getThreadId());
        } else {
            $app->flashNow('error', 'Echec de la sauvegarde');
            foreach ($postObject->getValidationFailures() as $failure) {
                $errors[$failure->getColumn()] = $failure->getMessage();
            }
            $posts  = PostQuery::create()->findTree($thread->getId());
            echo $app->view->render(
                'posts.html.twig',
                [
                    'thread' => $thread,
                    'posts'  => $posts,
                    'post'   => $postObject,
                    'active' => 'ideaBox',
                    'errors' => $errors,
                ]
            );
        }

    })->name('post_post');
