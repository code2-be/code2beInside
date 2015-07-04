<?php
namespace Code2be\Twig;

use Code2be\Twig\Globals\Assets;

class Extension extends \Twig_Extension
{
    public function getGlobals() {
        return array(
            'assets' => new Assets(),
        );
    }
    public function getName() {
        return 'code2be';
    }
}
