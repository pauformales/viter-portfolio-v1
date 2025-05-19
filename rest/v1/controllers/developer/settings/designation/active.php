<?php
// set http header
require '../../../../core/header.php';
// use needed function
require '../../../../core/functions.php';
// use model
require '../../../../models/developer/settings/designation/Designation.php';
// check database conection
$conn = null;
$conn = checkDbConnection();
// store model in variable
$designation = new Designation($conn);
// get payload
$body = file_get_contents("php://input");
$data = json_decode($body, true);
// VALIDATE API KEY
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    if (array_key_exists('designationid', $_GET)) {
        // CHECK DATA
        checkPayload($data);
        $designation->designation_aid = $_GET['designationid'];
        $designation->designation_is_active = trim($data['isActive']);
        $designation->designation_updated = date('Y-m-d H:i:s');

        checkId($designation->designation_aid);
        $query = checkActive($designation);
        returnSuccess($designation, 'designation active', $query);
    }
    // 404 if endpoint not available
    checkEndPoint();
}
