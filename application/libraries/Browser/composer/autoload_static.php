<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit03bb683046af3fbf74d523801b4e3938
{
    public static $classMap = array (
        'Browser' => __DIR__ . '/..' . '/cbschuld/browser.php/lib/Browser.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit03bb683046af3fbf74d523801b4e3938::$classMap;

        }, null, ClassLoader::class);
    }
}
