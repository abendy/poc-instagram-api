<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="bower_components/material-design-lite/material.min.css">
    <style>
    body { margin: 1em; }
    </style>
  </head>
  <body>
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

    $scope = [
      'basic',
      'likes',
      'public_content'
    ];

    $loginUrl = $instagram->getLoginUrl(['scope' => $scope]);

    ?>

    <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" href="<?php echo $loginUrl; ?>">Connect to Instagram</a>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">window.jQuery || document.write('<script src="/local/jquery.min.js"><\/script>')</script>
    <script defer src="./bower_components/material-design-lite/material.min.js"></script>
  </body>
</html>
