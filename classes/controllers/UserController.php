<?php
require_once(__DIR__ . "/../helpers/Database.php");
require_once(__DIR__ . "/../User.php");


class UserController
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function getUserByEmail($email): ?User
    {
        $stm = $this->conn->prepare("select *  from users where email=:email");
        $stm->bindParam(":email", $email);
        $stm->execute();
        $stm->setFetchMode(PDO::FETCH_CLASS, "User");
        $user = $stm->fetch() ?: null;
        return $user;
    }

    public function insertUser(User $user): ?string
    {
        $stm = $this->conn->prepare("insert into users (name, surname, email, password, secret) 
                                            values (:name, :surname, :email, :password, :secret)");
        $name = $user->getName();
        $surname = $user->getSurname();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $secret = $user->getSecret();
        $stm->bindParam(":name", $name);
        $stm->bindParam(":surname", $surname);
        $stm->bindParam(":email", $email);
        $stm->bindParam(":password", $password);
        $stm->bindParam(":secret", $secret);
        try {
            $stm->execute();
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            return null;
        }
    }

    public function validateUser(User $user): ?User
    {
        $stm = $this->conn->prepare("select name, surname, email, secret from users where email=:email AND password=:password limit 1");
        $email = $user->getEmail();
        $password = $user->getPassword();
        $stm->bindParam(":email", $email);
        $stm->bindParam(":password", $password);
        $stm->execute();
        $stm->setFetchMode(PDO::FETCH_CLASS, "User");
        return $stm->fetch() ?: null;
    }
}