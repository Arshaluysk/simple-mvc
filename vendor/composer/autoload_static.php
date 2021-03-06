<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4040b9676acda2a7defcc9aa48195f14
{
    public static $fallbackDirsPsr0 = array (
        0 => __DIR__ . '/../..' . '/controller',
        1 => __DIR__ . '/../..' . '/model',
        2 => __DIR__ . '/../..' . '/',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr0 = ComposerStaticInit4040b9676acda2a7defcc9aa48195f14::$fallbackDirsPsr0;
            $loader->classMap = ComposerStaticInit4040b9676acda2a7defcc9aa48195f14::$classMap;

        }, null, ClassLoader::class);
    }
}
