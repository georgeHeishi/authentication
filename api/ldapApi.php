<?php
require_once(__DIR__ . "/../classes/LoginAudit.php");
require_once(__DIR__ . "/../classes/controllers/LoginAuditController.php");

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

$ldapconfig['host'] = 'ldap.stuba.sk';
$ldapconfig['port'] = '389';
$ldapconfig['basedn'] = 'ou=People, DC=stuba, DC=sk';
$ldapconfig['usersdn'] = 'cn=users';//CHANGE THIS TO THE CORRECT USER OU/CN
$ds = ldap_connect($ldapconfig['host'], $ldapconfig['port']);

ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);

$dn = "uid=" . $username . "," . $ldapconfig['basedn'];
session_start();
if (isset($_POST['username'])) {
    if ($bind = ldap_bind($ds, $dn, $password)) {
        $loginAuditController = new LoginAuditController();
        $loginAudit = new LoginAudit();

        $sr = ldap_search($ds, "ou=People, DC=stuba, DC=sk", 'uid=' . $username, ['givenname', 'surname', 'mail']);
        $result = ldap_get_entries($ds, $sr);

        $_SESSION["name"] = $result[0]["givenname"][0];
        $_SESSION["surname"] = $result[0]["sn"][0];
        $_SESSION["email"] = $result[0]["mail"][0];
        $_SESSION["type"] = "ldap";

        $loginAudit->setEmail($result[0]["mail"][0]);
        $loginAudit->setTime(date("Y-m-d H:i:s"));
        $loginAudit->setLoginMethod("ldap");
        $loginAuditController->insertAudit($loginAudit);
        header("Location: https://wt98.fei.stuba.sk/authentication/");

    } else {
        header("Location: https://wt98.fei.stuba.sk/authentication/ldap.php/?error=1");
    }
}
