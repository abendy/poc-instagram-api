<?php

if (!session_id()) {
    session_start();
}

require_once 'vendor/autoload.php';

// Instagram
use Haridarshan\Instagram\Instagram;
use Haridarshan\Instagram\InstagramRequest;
use Haridarshan\Instagram\Exceptions\InstagramOAuthException;
use Haridarshan\Instagram\Exceptions\InstagramResponseException;
use Haridarshan\Instagram\Exceptions\InstagramServerException;

$creds = __DIR__ . '/credentials.json';

if (file_exists($creds)) {
    $json = file_get_contents($creds);

    $config = json_decode($json, true);
}

$protocol      = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';
$redirect_uri  = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/callback.php';
$access_token  = isset($_SESSION['access_token']) ? $_SESSION['access_token'] : '';

$config['Callback'] = $redirect_uri;

$instagram = new Instagram($config);

$scope = [
    'public_content'
];

$instagramRequestUser = new InstagramRequest($instagram, '/users/self', [ 'access_token' => $access_token ]);

$instagramRequestMedia = new InstagramRequest($instagram, '/users/self/media/recent', [ 'access_token' => $access_token, 'count' => 10 ]);

// Twig
$loader = new Twig_Loader_Filesystem('../templates');

$twig = new Twig_Environment($loader, array(
    'cache' => '../.cache',
    'debug' => true
));
