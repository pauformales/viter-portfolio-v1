<?php

$connection = null;
$conn = checkDbConnection(); // Check DB connection

// Create instance of the ServiceList model
$mainservice = new MainService($conn);

// GET method should not be used here
if (array_key_exists("mainserviceid", $_GET)) {
    checkEndpoint(); // Deny access if 'serviceid' is passed via GET
}

// Check if payload has value
checkPayload($data);

// Assign and validate input data
$mainservice->mainservice_title = checkIndex($data, 'mainservice_title');
$mainservice->mainservice_category = checkIndex($data, 'mainservice_category');
$mainservice->mainservice_description = checkIndex($data, 'mainservice_description');


// Set timestamps and status
$mainservice->mainservice_is_active = 1;
$mainservice->mainservice_created = date("Y-m-d H:i:s");
$mainservice->mainservice_updated = date("Y-m-d H:i:s");

isTitleExist($mainservice, $mainservice->mainservice_title);

// Call create function
$query = checkCreate($mainservice);
returnSuccess($mainservice, 'mainservice create', $query);
