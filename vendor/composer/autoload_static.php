<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit24a76baf6f67cf98e5c3af567fec0627
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'ad155f8f1cf0d418fe49e248db8c661b' => __DIR__ . '/..' . '/react/promise/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\DomCrawler\\' => 29,
            'Symfony\\Component\\CssSelector\\' => 30,
            'Symfony\\Component\\BrowserKit\\' => 29,
        ),
        'R' => 
        array (
            'React\\Promise\\' => 14,
        ),
        'J' => 
        array (
            'JansenFelipe\\Utils\\' => 19,
            'JansenFelipe\\CpfGratis\\' => 23,
            'JansenFelipe\\CnpjGratis\\' => 24,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Stream\\' => 18,
            'GuzzleHttp\\Ring\\' => 16,
            'GuzzleHttp\\' => 11,
            'Goutte\\' => 7,
        ),
        'F' => 
        array (
            'FirebaseMessaging\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\DomCrawler\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/dom-crawler',
        ),
        'Symfony\\Component\\CssSelector\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/css-selector',
        ),
        'Symfony\\Component\\BrowserKit\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/browser-kit',
        ),
        'React\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise/src',
        ),
        'JansenFelipe\\Utils\\' => 
        array (
            0 => __DIR__ . '/..' . '/jansenfelipe/utils/src',
        ),
        'JansenFelipe\\CpfGratis\\' => 
        array (
            0 => __DIR__ . '/..' . '/jansenfelipe/cpf-gratis/src',
        ),
        'JansenFelipe\\CnpjGratis\\' => 
        array (
            0 => __DIR__ . '/..' . '/jansenfelipe/cnpj-gratis/src',
        ),
        'GuzzleHttp\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/streams/src',
        ),
        'GuzzleHttp\\Ring\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/ringphp/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Goutte\\' => 
        array (
            0 => __DIR__ . '/..' . '/fabpot/goutte/Goutte',
        ),
        'FirebaseMessaging\\' => 
        array (
            0 => __DIR__ . '/..' . '/valdeirpsr/firebasemessaging-php/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Curl' => 
            array (
                0 => __DIR__ . '/..' . '/curl/curl/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit24a76baf6f67cf98e5c3af567fec0627::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit24a76baf6f67cf98e5c3af567fec0627::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit24a76baf6f67cf98e5c3af567fec0627::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}