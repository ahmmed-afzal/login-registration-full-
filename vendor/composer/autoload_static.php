<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit39e02506aa85a1c15ccec83e847e304d
{
    public static $files = array (
        '585c41152bb7e968817a07600a6789d9' => __DIR__ . '/../..' . '/helpers/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit39e02506aa85a1c15ccec83e847e304d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit39e02506aa85a1c15ccec83e847e304d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
