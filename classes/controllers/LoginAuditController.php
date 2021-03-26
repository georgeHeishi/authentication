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
        try {
            $stm->execute();
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            return null;
        }
    }
}