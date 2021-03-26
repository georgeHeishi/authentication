<?php
require_once(__DIR__ . "/handlers/checkHandler.php");
require_once(__DIR__ . "/../classes/User.php");
require_once(__DIR__ . "/../classes/LoginAudit.php");
require_once(__DIR__ . "/../classes/controllers/UserController.php");
require_once(__DIR__ . "/../classes/controllers/LoginAuditController.php");

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || empty($_POST["password"]) || empty($_POST["code"])) {
    header("Location: https://wt98.fei.stuba.sk/authentication/index.php/?loginChyba=1");
} else {
    $email = $_POST["email"];
    $password = hash("sha256", $_POST["password"]);
    $code = $_POST["code"];

    $user = new User();
    $user->setEmail($email);
    $user->setPassword($password);

    $userController = new UserController();

    $user = $userController->validateUser($user);
    if (is_null($user) || !checkSecret($code, $user->getSecret())) {
        header("Location: https://wt98.fei.stuba.sk/authentication/index.php/?loginChyba=2");
    } else {
        $loginAuditController = new LoginAuditController();
        $loginAudit = new LoginAudit();

        session_start();
        $_SESSION["name"] = $user->getName();
        $_SESSION["surname"] = $user->getSurname();
        $_SESSION["email"] = $user->getEmail();
        $_SESSION["type"] = 'basiclogin';

        $loginAudit->setEmail($user->getEmail());
        $loginAudit->setTime(date("Y-m-d H:i:s"));
        $loginAudit->setLoginMethod("basiclogin");
        $loginAuditController->insertAudit($loginAudit);

        header("Location: https://wt98.fei.stuba.sk/authentication/");
    }
}