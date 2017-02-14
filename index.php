<!doctype html>
<html class="no-js" lang="en" itemscope itemtype="http://schema.org/Product">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Login</title>
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

    echo "<p><a href='$loginUrl'>Connect to Instagram</a></p>";

    ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">window.jQuery || document.write('<script src="/local/jquery.min.js"><\/script>')</script>
  </body>
</html>
