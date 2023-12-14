<?php
    require_once 'vendor/autoload.php';

    $clientID = '272245545124-emckdlb3jk6vhulpm87sr00gsu30pegm.apps.googleusercontent.com';
    $clientSecret = "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";
    $redirectUri = 'http://localhost/login-register/index2.php';

    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");
?>
