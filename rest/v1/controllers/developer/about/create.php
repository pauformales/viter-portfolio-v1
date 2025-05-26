<?php

$connection = null;
$conn = checkDbConnection(); // Check DB connection

// Create instance of the MainaboutList model
$mainabout = new Mainabout($conn);

// GET method should not be used here
if (array_key_exists("mainaboutid", $_GET)) {
    checkEndpoint(); // Deny access if 'mainaboutid' is passed via GET
}

// Check if payload has value
checkPayload($data);

// Assign and validate input data
$mainabout->mainabout_title = checkIndex($data, 'mainabout_title');
$mainabout->mainabout_description = checkIndex($data, 'mainabout_description');








// Set timestamps and status
$mainabout->mainabout_is_active = 1;
$mainabout->mainabout_created = date("Y-m-d H:i:s");
$mainabout->mainabout_updated = date("Y-m-d H:i:s");

// Call create function
$query = checkCreate($mainabout);
returnSuccess($mainabout, 'mainabout create', $query);
