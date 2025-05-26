<?php

//CHECK DATABASE CONNECTION

$conn = null;
$conn = checkDbConnection();
//USE MODELS
$mainrecentwork = new Mainrecentwork($conn);

if (array_key_exists('mainrecentworkid', $_GET)) {
    // check data
    checkPayload($data);
    // CHECKING DATA
    $mainrecentwork->mainrecentwork_aid = $_GET['mainrecentworkid'];
    $mainrecentwork->mainrecentwork_title = checkIndex($data, 'mainrecentwork_title');
    $mainrecentwork->mainrecentwork_description = checkIndex($data, 'mainrecentwork_description');
    $mainrecentwork->mainrecentwork_is_active = 1;
    $mainrecentwork->mainrecentwork_created = date("Y-m-d H:i:s");
    $mainrecentwork->mainrecentwork_updated = date("Y-m-d H:i:s");


    // VALIDATION
    checkId($mainrecentwork->mainrecentwork_aid);


    $query = checkUpdate($mainrecentwork);
    returnSuccess($mainrecentwork, 'portfolio list update', $query);
}

// exit if not available

checkEndPoint();
