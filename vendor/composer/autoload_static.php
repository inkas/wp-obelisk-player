<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit787c8554b7ef7d7bc119bfc70d307898
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Includes\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Includes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit787c8554b7ef7d7bc119bfc70d307898::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit787c8554b7ef7d7bc119bfc70d307898::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}