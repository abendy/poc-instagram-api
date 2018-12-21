<?php
require_once '../config.php';

try {
    $oauth = $instagram->oauth($_GET['code']);

    $access_token = $oauth->getAccessToken();

    if ($access_token) {
        $_SESSION['access_token'] = $access_token;

        header('Location: /');
    }
} catch (InstagramOAuthException $e) {
    echo '<h2>Oauth Error</h2><p>' . $e->getMessage() . '</p>';
    exit;
}
