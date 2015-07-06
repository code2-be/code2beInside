<?php

namespace Code2be\Helper;


class Form
{
    public static function handleRequest($post, &$object) {
        foreach ($post as $key => $value) {
            if ($key == 'id' || !method_exists($object, "set".ucfirst($key))) {
                continue;
            }
            $value = ($value=='')?null:$value;
            call_user_func_array([$object, "set".ucfirst($key)],[$value]);
        }
        return $object;
    }
}
