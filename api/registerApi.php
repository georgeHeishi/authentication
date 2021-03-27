<?php
if (empty($_POST["name"]) || empty($_POST["surname"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) ||
    empty($_POST["password"]) || empty($_POST["password-verify"]) || empty($_POST["secret"])) {
    header("Location: https://wt98.fei.stuba.sk/authentication/index.php/?registerError=1");
} else {
    require_once(__DIR__ . "/../classes/User.php");
    require_once(__DIR__ . "/../classes/controllers/UserController.php");

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordVerify = $_POST["password-verify"];
    $secret = $_POST["secret"];

    if (strcmp($password, $passwordVerify) != 0 || strlen($password) > 16) {
        header("Location: https://wt98.fei.stuba.sk/authentication/index.php/?registerError=2");
    } else {

        $password = hash('sha256', $password);
        echo $password;
        $userController = new UserController();
        $user = $userController->getUserByEmail($email);

        if (is_null($user)) {
            $user = new User();
            $user->setName($name);
            $user->setSurname($surname);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setSecret($secret);
            $userController->insertUser($user);

            header("Location: https://wt98.fei.stuba.sk/authentication/index.php/");
        }else{
            header("Location: https://wt98.fei.stuba.sk/authentication/index.php/?registerError=3");
        }
    }
}