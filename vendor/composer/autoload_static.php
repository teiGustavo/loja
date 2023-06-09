<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit110122f6a875e2eafd12f6f0cb7fc6a2
{
    public static $files = array (
        '9541ed774a992d9c687c4c094b97af42' => __DIR__ . '/../..' . '/src/Config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Uptodown\\RandomUsernameGenerator\\' => 33,
        ),
        'L' => 
        array (
            'Loja\\' => 5,
            'League\\Plates\\' => 14,
        ),
        'H' => 
        array (
            'Hackzilla\\PasswordGenerator\\' => 28,
        ),
        'C' => 
        array (
            'CoffeeCode\\Router\\' => 18,
            'CoffeeCode\\DataLayer\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Uptodown\\RandomUsernameGenerator\\' => 
        array (
            0 => __DIR__ . '/..' . '/uptodown/random-username-generator/src',
        ),
        'Loja\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'League\\Plates\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/plates/src',
        ),
        'Hackzilla\\PasswordGenerator\\' => 
        array (
            0 => __DIR__ . '/..' . '/hackzilla/password-generator',
        ),
        'CoffeeCode\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/router/src',
        ),
        'CoffeeCode\\DataLayer\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/datalayer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit110122f6a875e2eafd12f6f0cb7fc6a2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit110122f6a875e2eafd12f6f0cb7fc6a2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit110122f6a875e2eafd12f6f0cb7fc6a2::$classMap;

        }, null, ClassLoader::class);
    }
}
