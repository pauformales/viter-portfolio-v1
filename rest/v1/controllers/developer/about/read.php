<?php

// check database connection
$conn = null;
$conn = checkDbConnection();

// make instance of classes or use the model
$mainabout = new Mainabout($conn);

if (array_key_exists("mainaboutid", $_GET)) {
    $mainaboutid->mainabout_id = $_GET['mainaboutid'];
    checkId($mainabout->mainabout_aid);
    $query = checkReadById($mainabout);
    http_response_code(200);
    getQueriedData($query);
}

if (empty($_GET)) {
    $query = checkReadAll($mainabout);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();
