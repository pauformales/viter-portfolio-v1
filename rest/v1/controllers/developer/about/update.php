<?php

//CHECK DATABASE CONNECTION

$conn = null;
$conn = checkDbConnection();
//USE MODELS
$mainabout = new Mainabout($conn);

if (array_key_exists('mainaboutid', $_GET)) {
    // check data
    checkPayload($data);
    // CHECKING DATA
    $mainabout->mainabout_aid = $_GET['mainaboutid'];
    $mainabout->mainabout_title = checkIndex($data, 'mainabout_title');
    $mainabout->mainabout_description = checkIndex($data, 'mainabout_description');
    $mainabout->mainabout_is_active = 1;
    $mainabout->mainabout_created = date("Y-m-d H:i:s");
    $mainabout->mainabout_updated = date("Y-m-d H:i:s");


    // VALIDATION
    checkId($mainabout->mainabout_aid);


    $query = checkUpdate($mainabout);
    returnSuccess($mainabout, 'portfolio list update', $query);
}

// exit if not available

checkEndPoint();
