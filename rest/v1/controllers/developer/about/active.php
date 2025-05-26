<?php
// set http header
require '../../../core/header.php';
// use needed function
require '../../../core/functions.php';
require './function.php';

// use model
require '../../../models/developer/about/MainAbout.php';


// check database connection
$conn = null;
$conn = checkDbConnection();
// store model in variable
$mainabout = new Mainabout($conn);
// get payload
$body = file_get_contents("php://input");
$data = json_decode($body, true);

// VALIDATE API KEY
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    if (array_key_exists('mainaboutid', $_GET)) {
        //CHECK DATA
        checkPayload($data);
        $mainabout->mainabout_aid = $_GET['mainaboutid'];
        $mainabout->mainabout_is_active = trim($data['isActive']);
        $mainabout->mainabout_updated = date('Y-m-d H:i:s');


        checkId($mainabout->mainabout_aid);
        $query = checkActive($mainabout);
        returnSuccess($mainabout, 'mainabout active', $query);
    }

    // 404 if endpoint not available
    checkEndpoint();
}
