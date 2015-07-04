<?php

namespace Code2be\Helper;


class Form
{
    public static function handleRequest($post, &$object) {
        foreach ($post as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            $value = ($value=='')?null:$value;
            call_user_func_array([$object, "set".ucfirst($key)],[$value]);
        }
        return $object;
    }
}
