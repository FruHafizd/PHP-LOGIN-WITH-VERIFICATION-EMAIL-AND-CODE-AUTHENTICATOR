<?php

spl_autoload_register(function($class) {
    require_once __DIR__ . '/controllers/' . $class . '.php';
});

// spl_autoload_register(function($class) {
//     $class = explode('\\', $class);
//     $class = end($class);
//     require_once __DIR__ .'/controllers/' . $class . '.php';
// });

// spl_autoload_register(function($class) {
//     $class = explode('\\', $class);
//     $class = end($class);
//     require_once __DIR__ .'/service/' . $class . '.php';
// });
