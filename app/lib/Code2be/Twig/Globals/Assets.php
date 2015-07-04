<?php

namespace Code2be\Twig\Globals;

class Assets {
    public function getJavascripts() {
        $files = scandir($_SERVER['DOCUMENT_ROOT'].'/js');
        $js    = [];
        foreach ($files as $file) {
            if (strpos($file, '.js') != '') {
                $js[] = '/js/'.$file;
            }
        }
        return $js;
    }
    public function getStylesheets() {
        $files = scandir($_SERVER['DOCUMENT_ROOT'].'/css');
        $css    = [];
        foreach ($files as $file) {
            if (strpos($file, '.css') != '') {
                $css[] = '/css/'.$file;
            }
        }
        return $css;
    }
}
