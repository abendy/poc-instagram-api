<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

        <title>poc-instagram-api</title>

        <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon" />

        <link rel="stylesheet" href="assets/dist/main.css">
    </head>
    <body>

        <div id="main">
        <?php
        require_once '../config.php';

        // Set button
        $button = array(
            'text' => 'Connect to Instagram',
            'href' => $instagram->getLoginUrl(['scope' => $scope])
        );

        if ($access_token) {
        // Set access token
            $instagram->setAccessToken($access_token);

            $button = array(
                'text' => 'Exit',
                'href' => 'exit.php'
            );
        }

        echo $twig->render('button.twig', $button);

        // Get Instagram data
        if ($instagram->getOAuth()->isAccessTokenSet()) {
            try {
                // Get user data
                $user_data = $instagramRequestUser->getResponse()->getData();


                d($instagramRequestUser->getResponse());



                echo $twig->render('profile.twig', array(
                    'profile_picture' => $user_data->profile_picture,
                    'full_name'       => $user_data->full_name,
                    'username'        => $user_data->username,
                    'bio'             => $user_data->bio,
                    'website'         => $user_data->website
                ));

                // Get media data
                $media_data = $instagramRequestMedia->getResponse()->getData();

                echo $twig->render('media.twig', array('images' => $media_data));
            } catch (InstagramResponseException $e) {
                echo '<p>Error ' . $e->getMessage() . '</p>';
            } catch (InstagramServerException $e) {
                echo '<p>Error ' . $e->getMessage() . '</p>';
            }
        }
        ?>
        </div>

        <script defer src="assets/dist/main.js"></script>
    </body>
</html>
