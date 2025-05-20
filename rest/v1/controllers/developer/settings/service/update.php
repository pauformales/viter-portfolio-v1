<?php

//CHECK DATABASE CONNECTION

$conn = null;
$conn = checkDbConnection();
//USE MODELS
$service = new Service($conn);

if (array_key_exists('serviceid', $_GET)) {
    // check data
    checkPayload($data);
    // CHECKING DATA
    $service->service_aid = $_GET['serviceid'];
    $service->service_title = checkIndex($data, 'service_title');
    $service->service_description = checkIndex($data, 'service_description');
    $service->service_is_active = 1;
    $service->service_created = date("Y-m-d H:i:s");
    $service->service_updated = date("Y-m-d H:i:s");





    // VALIDATION
    checkId($service->service_aid);

    $service_title_old = checkIndex($data, 'service_title_old');
    compareTitle($service, $service->service_title, $service_title_old);


    $query = checkUpdate($service);
    returnSuccess($service, 'portfolio list update', $query);
}

// exit if not available

checkEndPoint();
