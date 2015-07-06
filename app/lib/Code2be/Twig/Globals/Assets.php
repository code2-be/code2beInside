<?php

namespace Code2be\Twig\Globals;

class Assets {
    public function getJavascripts() {
        $files = scandir(__ROOT__.'/public_html/js');
        $js    = [];
        foreach ($files as $file) {
            if (strpos($file, '.js') != '') {
                $js[] = '/js/'.$file;
            }
        }
        return $js;
    }
    public function getStylesheets() {
        $files = scandir(__ROOT__.'/public_html/css');
        $css    = [];
        foreach ($files as $file) {
            if (strpos($file, '.css') != '') {
                $css[] = '/css/'.$file;
            }
        }
        return $css;
    }
}
