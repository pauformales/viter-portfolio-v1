<?php
// set http header
require '../../../../core/header.php';
// use needed function
require '../../../../core/functions.php';


// use model
require '../../../../models/developer/settings/service/Service.php';
// check database conection
$conn = null;
$conn = checkDbConnection();
// store model in variable
$service = new Service($conn);
// get payload
$body = file_get_contents("php://input");
$data = json_decode($body, true);
// VALIDATE API KEY
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    if (array_key_exists('serviceid', $_GET)) {
        // CHECK DATA
        checkPayload($data);
        $service->service_aid = $_GET['serviceid'];
        $service->service_is_active = trim($data['isActive']);
        $service->service_updated = date('Y-m-d H:i:s');

        checkId($service->service_aid);
        $query = checkActive($service);
        returnSuccess($service, 'service active', $query);
    }
    // 404 if endpoint not available
    checkEndPoint();
}
