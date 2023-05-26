<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit595550ed8cdb5c332b41df4c86719822
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit595550ed8cdb5c332b41df4c86719822::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit595550ed8cdb5c332b41df4c86719822::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit595550ed8cdb5c332b41df4c86719822::$classMap;

        }, null, ClassLoader::class);
    }
}
