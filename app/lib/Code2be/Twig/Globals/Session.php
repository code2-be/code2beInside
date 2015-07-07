<?php

namespace Code2be\Twig\Globals;

use Code2be\Helper\Auth;

class Session {
    public function getUser() {
        return Auth::getUser();
    }
}


