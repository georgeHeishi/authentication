<?php
require_once(__DIR__ . "/../helpers/Database.php");
require_once(__DIR__ . "/../LoginAudit.php");


class LoginAuditController
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function insertAudit(LoginAudit $loginAudit): ?string
    {
        $stm = $this->conn->prepare("insert into login_audit (email, time, login_method) 
                                            values (:email, :time, :login_method)");
        $email = $loginAudit->getEmail();
        $time = $loginAudit->getTime();
        $login_method = $loginAudit->getLoginMethod();
        $stm->bindParam(":email", $email);
        $stm->bindParam(":time", $time);
        $stm->bindParam(":login_method", $login_method);
        $stm->execute();
        return $this->conn->lastInsertId();
    }

    public function getLogins(string $email): ?array
    {
        $stm = $this->conn->prepare("select * from login_audit where email=:email order by id");
        $stm->bindParam(":email", $email);
        try {
            $stm->execute();

            $stm->setFetchMode(PDO::FETCH_CLASS, "LoginAudit");
            return $stm->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    public function getStats(): array
    {
        $stm = $this->conn->prepare("select login_method, count(*) as count from login_audit where login_method='basiclogin'");
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stats = array();
        $stats["basiclogin"] = $result[0]["count"];

        $stm = $this->conn->prepare("select login_method, count(*) as count from login_audit where login_method='oauth2'");
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stats["oauth2"] = $result[0]["count"];

        $stm = $this->conn->prepare("select login_method, count(*) as count from login_audit where login_method='ldap'");
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stats["ldap"] = $result[0]["count"];

        return $stats;
    }
}