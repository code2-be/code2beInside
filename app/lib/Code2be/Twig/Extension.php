<?php
namespace Code2be\Twig;

use Code2be\Twig\Globals\Assets;
use Code2be\Twig\Globals\Session;

class Extension extends \Twig_Extension
{
    public function getGlobals() {
        return array(
            'assets'  => new Assets(),
            'session' => new Session(),
        );
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('is_granted', function($roles) {
                return \Code2be\Helper\Voter::isGranted($roles);
            }),
        );
    }

    public function getName() {
        return 'code2be';
    }
}
