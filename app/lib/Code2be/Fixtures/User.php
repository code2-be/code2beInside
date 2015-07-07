<?php

namespace Code2be\Fixtures;

class User {

    public static function load() {
        $user = new \Code2be\Model\User;
        $user->setFirstName('Admin');
        $user->setLastName('Foo');
        $user->setPassword(password_hash('p@ss', PASSWORD_BCRYPT));
        $user->setEmail('admin@code2.be');
        $user->setRole('ROLE_PRESIDENT');
        $user->save();
    }

}

?>
