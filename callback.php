<!doctype html>
<html class="no-js" lang="en" itemscope itemtype="http://schema.org/Product">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Callback</title>

    <link rel="stylesheet" href="bower_components/material-design-lite/material.min.css" type="text/css" />
  </head>
  <body>
    <p><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" href="/">Home</a></p>

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
  </body>
</html>
