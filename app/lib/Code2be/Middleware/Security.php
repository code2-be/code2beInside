<?php

namespace Code2be\Middleware;


class Security extends \Slim\Middleware
{
    public function call() {
        if (
            ( isset($_SESSION['authentificated']) &&
              $_SESSION['authentificated'] == true ) ||
            $this->app->request->getResourceUri() == '/login'
        ) {
            $this->next->call();
        } else {
            return $this->app->response()->redirect('/login');
        }
    }
}
