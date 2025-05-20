<?php

// check database connection
$conn = null;
$conn = checkDbConnection();

// make instance of classes or use the model
$service = new Service($conn);

if (array_key_exists("serviceid", $_GET)) {
    $serviceid->service_id = $_GET['serviceid'];
    checkId($service->service_aid);
    $query = checkReadById($service);
    http_response_code(200);
    getQueriedData($query);
}

if (empty($_GET)) {
    $query = checkReadAll($service);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();
