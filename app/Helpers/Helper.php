<?php


if (!function_exists('route')) {
    function route($name)
    {
        return route($name, app()->getLocale());
    }
}