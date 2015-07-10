<?php
namespace Code2be\Twig;

use Code2be\Twig\Globals\Assets;
use Code2be\Twig\Globals\Session;

class Extension extends \Twig_Extension
{
    private $twigEnvironment;

    public function __construct($twigEnvironment) {
        $this->twigEnvironment = $twigEnvironment;
    }

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
            new \Twig_SimpleFunction('input_tag', function($phpName, $label, $value, $errors, $columnName) {
                echo $this->twigEnvironment->render(
                    'form/inputTag.html.twig',
                    [
                        'phpName'    => $phpName,
                        'label'      => $label,
                        'value'      => $value,
                        'errors'     => $errors,
                        'columnName' => $columnName,
                        'type'       => 'text',
                    ]
                );
            }),
            new \Twig_SimpleFunction('input_tag_mail', function($phpName, $label, $value, $errors, $columnName) {
                echo $this->twigEnvironment->render(
                    'form/inputTag.html.twig',
                    [
                        'phpName'    => $phpName,
                        'label'      => $label,
                        'value'      => $value,
                        'errors'     => $errors,
                        'columnName' => $columnName,
                        'type'       => 'mail',
                    ]
                );
            }),
            new \Twig_SimpleFunction('select_tag', function($phpName, $label, $choices, $selected, $errors, $columnName) {
                echo $this->twigEnvironment->render(
                    'form/selectTag.html.twig',
                    [
                        'phpName'    => $phpName,
                        'label'      => $label,
                        'choices'    => $choices,
                        'selected'   => $selected,
                        'errors'     => $errors,
                        'columnName' => $columnName,
                    ]
                );
            }),
        );
    }

    public function getName() {
        return 'code2be';
    }
}
