<?php

namespace Code2be\Fixtures;

class User {

    public static function load() {
        $user = new \Code2be\Model\User;
        $user->setFirstName('Yoann');
        $user->setLastName('C');
        $user->setPassword(password_hash('p@ss', PASSWORD_BCRYPT));
        $user->setEmail('yoann@c.be');
        $user->setRole('ROLE_TREASURER');
        $user->save();
    }

}

?>
