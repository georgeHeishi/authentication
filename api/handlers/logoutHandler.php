<?php
require_once(__DIR__ . "/../google-api/vendor/autoload.php");

function oatuh2Logout()
{
    //Unset token from session
    unset($_SESSION['upload_token']);
    $client = new Google_Client();
    $client->setAuthConfig(__DIR__ . '/../../../../configs/credentials.json');

    // Reset OAuth access token
    $client->revokeToken();
}