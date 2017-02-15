<?php

require_once 'vendor/autoload.php';

use Haridarshan\Instagram\Instagram;
use Haridarshan\Instagram\InstagramRequest;
use Haridarshan\Instagram\Exceptions\InstagramOAuthException;
use Haridarshan\Instagram\Exceptions\InstagramResponseException;
use Haridarshan\Instagram\Exceptions\InstagramServerException;

require_once(__DIR__ . '/config.php');

$instagram = new Instagram(array(
  'ClientId' => $client_id,
  'ClientSecret' => $client_secret,
  'Callback' => $redirect_uri
));

try {

  $code = $_GET['code'];

  $oauth = $instagram->oauth($code);

  $access_token = $oauth->getAccessToken();

  if ($access_token) {

    $_SESSION['access_token'] = $access_token;

    header("Location: account.php");

  }

} catch (InstagramOAuthException $e) {

  echo "<p>Error " . $e->getMessage() . "</p>";

  exit;

}

?>
