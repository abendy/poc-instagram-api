<!doctype html>
<html class="no-js" lang="en" itemscope itemtype="http://schema.org/Product">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Account</title>
  </head>
  <body>
    <p><a href="/">Home</a></p>

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

      $access_token = $_GET['access_token'];

      // $instagram->setAccessToken($access_token);

      // User

      $user = new InstagramRequest($instagram, "/users/self", [ "access_token" => $access_token ]);

      $user_data = $user->getResponse()->getData();

      echo "<p><img src='$user_data->profile_picture' /></p>";
      echo "<h1>$user_data->username</h1>";

      // Media

      $media = new InstagramRequest($instagram, "/users/self/media/recent", [ "count" => 10, "access_token" => $access_token ]);

      $media_data = $media->getResponse()->getData();

      if (!isset($media_data['images'])) echo "<p>No images</p>"; exit;

      Kint::dump($media_data['images']);

      foreach($media_data->images as $key => $image) {
        $url = $value->standard_resolution->url;

        echo "<p><img src='$url' /></p>";
      }

    } catch(InstagramResponseException $e) {
      echo "<p>Error " . $e->getMessage() . "</p>";
    } catch(InstagramServerException $e) {
      echo "<p>Error " . $e->getMessage() . "</p>";
    }

    ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">window.jQuery || document.write('<script src="/local/jquery.min.js"><\/script>')</script>
  </body>
</html>
