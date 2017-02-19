<?php

require_once(__DIR__ . '/config.php');

try {

  $code = $_GET['code'];

  $oauth = $instagram->oauth($code);

  $access_token = $oauth->getAccessToken();

  if ($access_token) {

    $_SESSION['access_token'] = $access_token;

    header("Location: /");

  }

} catch (InstagramOAuthException $e) {

  echo "<p>Error " . $e->getMessage() . "</p>";

  exit;

}

?>
