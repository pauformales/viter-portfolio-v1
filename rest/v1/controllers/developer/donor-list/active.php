<?php
// set http header
require '../../../core/header.php';
// use needed function
require '../../../core/functions.php';
// use model
require '../../../models/developer/donor-list/DonorList.php';
// check database conection
$conn = null;
$conn = checkDbConnection();
// store model in variable
$donorList = new DonorList($conn);
// get payload
$body = file_get_contents("php://input");
$data = json_decode($body, true);
// VALIDATE API KEY
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    if (array_key_exists('donorListid', $_GET)) {
        // CHECK DATA
        checkPayload($data);
        $donorList->donor_list_aid = $_GET['donorListid'];
        $donorList->donor_list_is_active = trim($data['isActive']);
        $donorList->donor_list_updated = date('Y-m-d H:i:s');

        checkId($donorList->donor_list_aid);
        $query = checkActive($donorList);
        returnSuccess($donorList, 'donor active', $query);
    }
    // 404 if endpoint not available
    checkEndPoint();
}
