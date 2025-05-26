<?php
// set http header
require '../../../core/header.php';
// use needed function
require '../../../core/functions.php';
// use model
require '../../../models/developer/service/MainService.php';
// check database conection
$conn = null;
$conn = checkDbConnection();
// store model in variable
$mainservice = new MainService($conn);
// get payload
$body = file_get_contents("php://input");
$data = json_decode($body, true);
// VALIDATE API KEY
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    if (array_key_exists('mainserviceid', $_GET)) {
        // CHECK DATA
        checkPayload($data);
        $mainservice->mainservice_aid = $_GET['mainserviceid'];
        $mainservice->mainservice_is_active = trim($data['isActive']);
        $mainservice->mainservice_updated = date('Y-m-d H:i:s');

        checkId($mainservice->mainservice_aid);
        $query = checkActive($mainservice);
        returnSuccess($mainservice, 'mainservice active', $query);
    }
    // 404 if endpoint not available
    checkEndPoint();
}
