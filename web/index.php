<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Login</title>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="vendor/material-design-lite/material.min.css">
    <link rel="stylesheet" href="assets/style.css">
  </head>
  <body>
    <?php

    require_once('../config.php');

    if (!$access_token) {
      $loginUrl = $instagram->getLoginUrl(['scope' => $scope]);

      echo $twig->render('login.twig', array('loginUrl' => $loginUrl));
    }

    // Set access token
    if ($access_token) {
      $instagram->setAccessToken($access_token);
    }

    if ($instagram->getOAuth()->isAccessTokenSet()) {

      try {

        // User

        $user_data = $instagramRequestUser->getResponse()->getData();

        echo $twig->render('profile.twig', array(
          'profile_picture' => $user_data->profile_picture, 
          'full_name'       => $user_data->full_name,
          'username'        => $user_data->username,
          'bio'             => $user_data->bio,
          'website'         => $user_data->website
        ));

        // Media

        $media_data = $instagramRequestMedia->getResponse()->getData();

        echo $twig->render('media.twig', array('images' => $media_data->images));

        session_destroy();

      } catch(InstagramResponseException $e) {

        echo "<p>Error " . $e->getMessage() . "</p>";

      } catch(InstagramServerException $e) {

        echo "<p>Error " . $e->getMessage() . "</p>";

      }

    }
    ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">window.jQuery || document.write('<script src="/local/jquery.min.js"><\/script>')</script>
    <script defer src="vendor/material-design-lite/material.min.js"></script>
  </body>
</html>
