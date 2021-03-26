<?php
require_once (__DIR__ . '/../PHPGangsta/GoogleAuthenticator.php');


function checkSecret($code, $secret): bool
{
    $ga = new PHPGangsta_GoogleAuthenticator();
    $result = $ga->verifyCode($secret, $code);

    if ($result == 1) {
        return true;
    } else {
        return false;
    }
}