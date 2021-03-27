<?php
require_once(__DIR__ . "/../classes/controllers/LoginAuditController.php");
require_once(__DIR__ . "/../classes/LoginAudit.php");

// Takes raw data from the request
$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json);
if (!is_null($data)) {
    $email = $data->email;

    $loginAuditController = new LoginAuditController();
    $audits = $loginAuditController->getLogins($email);
    if (!is_null($audits)) {
        $results = array();

        foreach ($audits as $audit) {
            array_push($results, $audit->toArray());
        }

        $response = array(
            "status" => "success " . $email,
            "error" => false,
            "results" => json_encode($results),
        );
        echo json_encode($response);
    } else {
        $response = array(
            "status" => "error fetching audits from db",
            "error" => true,
        );
        echo json_encode($response);
    }
} else {
    $response = array(
        "status" => "data array empty",
        "error" => true,
    );
    echo json_encode($response);
}