<?php

// check dataase conncetion
$conn = null;
$conn = checkDbConnection();
// make instance of classes or use the model
$mainservice = new MainService($conn);

if (array_key_exists("mainserviceid", $_GET)) {
    $mainservice->mainservice_aid = $_GET['mainserviceid'];
    checkId($mainservice->mainservice_aid);
    $query = checkReadById($mainservice);
    http_response_code(200);
    getQueriedData($query);
}

if (empty($_GET)) {
    $query = checkReadAll($mainservice);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
