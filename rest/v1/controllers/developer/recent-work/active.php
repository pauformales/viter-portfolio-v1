<?php
// set http header
require '../../../core/header.php';
// use needed function
require '../../../core/functions.php';
require './function.php';

// use model
require '../../../models/developer/recent-work/MainRecentWork.php';


// check database connection
$conn = null;
$conn = checkDbConnection();
// store model in variable
$mainrecentwork = new Mainrecentwork($conn);
// get payload
$body = file_get_contents("php://input");
$data = json_decode($body, true);

// VALIDATE API KEY
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    if (array_key_exists('mainrecentworkid', $_GET)) {
        //CHECK DATA
        checkPayload($data);
        $mainrecentwork->mainrecentwork_aid = $_GET['mainrecentworkid'];
        $mainrecentwork->mainrecentwork_is_active = trim($data['isActive']);
        $mainrecentwork->mainrecentwork_updated = date('Y-m-d H:i:s');


        checkId($mainrecentwork->mainrecentwork_aid);
        $query = checkActive($mainrecentwork);
        returnSuccess($mainrecentwork, 'mainrecentwork active', $query);
    }

    // 404 if endpoint not available
    checkEndpoint();
}
