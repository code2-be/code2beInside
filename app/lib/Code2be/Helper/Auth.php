<?php

namespace Code2be\Helper;

use Code2be\Model\UserQuery;
use Code2be\Model\User;

class Auth
{
    public static function login($post) {
        $user = UserQuery::create()
            ->findOneByEmail($post['email']);

        if (!$user instanceof User) {
            return false;
        }

        if (!password_verify($post['password'], $user->getPassword())) {
            return false;
        }

        $_SESSION['authentificated'] = true;
        $_SESSION['user'] = $user->toJSON();

        return true;
    }

    public static function logout() {
        $_SESSION['authentificated'] = false;
        $_SESSION['user'] = null;
    }

    /**
     * @return Code2be\Model\User
     */
    public static function getUser() {
        $user = new User();
        $user->fromJSON($_SESSION['user']);
        return $user;
    }

    public static function generatePassword($user) {

        $pass = self::getNewPassword();
        $user->setPassword(password_hash($pass, PASSWORD_BCRYPT));
        $user->save();
        self::sendPasswordByMail($user, $pass);
    }


    public static function getNewPassword() {
        $characts   = 'abcdefghijklmnopqrstuvwxyz';
        $characts  .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characts  .= '1234567890';
        $pass       = '';

        for($i=0;$i < 10;$i++) {
            $pass .= substr($characts, rand() % strlen($characts), 1);
        }

        return $pass;
    }

    public static function sendPasswordByMail($user, $pass) {
        // Paramaters for database connections
        $parser = new \Symfony\Component\Yaml\Parser;
        $yaml   = $parser->parse(file_get_contents(__ROOT__.'/app/config/parameters.yml'));

        $transport = \Swift_SmtpTransport::newInstance($yaml['mailer']['host'], 25)
          ->setUsername($yaml['mailer']['user'])
          ->setPassword($yaml['mailer']['password'])
        ;

        // Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

        // Create a message
        $message = \Swift_Message::newInstance('Votre mot de passe Code2be Inside')
          ->setFrom(array($yaml['mailer']['sender']))
          ->setTo(array($user->getEmail()))
          ->setBody("Bonjour,

Voici votre mot de passe membre Code2be Inside !

$pass

A bientôt,
L’Equipe Code2be Inside.
              ")
          ;
        // Send the message
        $result = $mailer->send($message);
    }
}
