<?php
session_start();
require_once(__DIR__ . "/google-api/vendor/autoload.php");
require_once (__DIR__. "/../classes/LoginAudit.php");
require_once (__DIR__. "/../classes/cotrollers/LoginAuditController.php");

$redirect_uri = 'https://wt98.fei.stuba.sk/authentication/api/oauth2.php';

$client = new Google_Client();
$client->setAuthConfig('/home/xlapcak/configs/credentials.json');
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

$service = new Google_Service_Oauth2($client);

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);
    $_SESSION['upload_token'] = $token;

    // redirect back to the example
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

// set the access token as part of the client
if (!empty($_SESSION['upload_token'])) {
    $client->setAccessToken($_SESSION['upload_token']);
    if ($client->isAccessTokenExpired()) {
        unset($_SESSION['upload_token']);
    }
} else {
    $authUrl = $client->createAuthUrl();
}

if ($client->getAccessToken()) {
    //Get user profile data from google
    $UserProfile = $service->userinfo->get();
    if (!empty($UserProfile)) {
        $loginAuditController = new LoginAuditController();
        $loginAudit = new LoginAudit();

        $_SESSION["name"] = $UserProfile['given_name'];
        $_SESSION["surname"] = $UserProfile['family_name'];
        $_SESSION["email"] = $UserProfile['email'];
        $_SESSION["type"] = 'oauth2';

        $loginAudit->setEmail($UserProfile['email']);
        $loginAudit->setTime(date("Y-m-d H:i:s"));
        $loginAudit->setLoginMethod("oauth2");
        $_SESSION["tmp"] = $loginAudit->getEmail() . " - " . $loginAudit->getTime() . " - " . $loginAudit->getLoginMethod();
        $loginAuditController->insertAudit($loginAudit);
        header("Location: https://wt98.fei.stuba.sk/authentication/");
    } else {
        $_SESSION["error"] = "Some problem occurred, please try again.";
    }
}else {
    header("Location: " . $client->createAuthUrl());
}