<?php
// set http header
require '../../../core/header.php';
// use needed function
require '../../../core/functions.php';
// use model
require '../../../models/developer/experience/MainExperience.php';
// check database conection
$conn = null;
$conn = checkDbConnection();
// store model in variable
$mainexperience = new MainExperience($conn);
// get payload
$body = file_get_contents("php://input");
$data = json_decode($body, true);
// VALIDATE API KEY
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    if (array_key_exists('mainexperienceid', $_GET)) {
        // CHECK DATA
        checkPayload($data);
        $mainexperience->mainexperience_aid = $_GET['mainexperienceid'];
        $mainexperience->mainexperience_is_active = trim($data['isActive']);
        $mainexperience->mainexperience_updated = date('Y-m-d H:i:s');

        checkId($mainexperience->mainexperience_aid);
        $query = checkActive($mainexperience);
        returnSuccess($mainexperience, 'mainexperience active', $query);
    }
    // 404 if endpoint not available
    checkEndPoint();
}
