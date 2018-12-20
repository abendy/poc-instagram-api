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
    echo '<p>Error ' . $e->getMessage() . '</p>';
    exit;
}
