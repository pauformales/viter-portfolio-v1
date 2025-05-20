<?php

$connection = null;
$conn = checkDbConnection(); // Check DB connection

// Create instance of the ServiceList model
$service = new Service($conn);

// GET method should not be used here
if (array_key_exists("serviceid", $_GET)) {
    checkEndpoint(); // Deny access if 'serviceid' is passed via GET
}

// Check if payload has value
checkPayload($data);

// Assign and validate input data
$service->service_title = checkIndex($data, 'service_title');
$service->service_description = checkIndex($data, 'service_description');





isTitleExist($service, $service->service_title);



// Set timestamps and status
$service->service_is_active = 1;
$service->service_created = date("Y-m-d H:i:s");
$service->service_updated = date("Y-m-d H:i:s");

// Call create function
$query = checkCreate($service);
returnSuccess($service, 'service create', $query);
