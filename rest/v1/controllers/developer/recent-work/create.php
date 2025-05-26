<?php

$connection = null;
$conn = checkDbConnection(); // Check DB connection

// Create instance of the MainrecentworkList model
$mainrecentwork = new Mainrecentwork($conn);

// GET method should not be used here
if (array_key_exists("mainrecentworkid", $_GET)) {
    checkEndpoint(); // Deny access if 'mainrecentworkid' is passed via GET
}

// Check if payload has value
checkPayload($data);

// Assign and validate input data
$mainrecentwork->mainrecentwork_title = checkIndex($data, 'mainrecentwork_title');
$mainrecentwork->mainrecentwork_description = checkIndex($data, 'mainrecentwork_description');








// Set timestamps and status
$mainrecentwork->mainrecentwork_is_active = 1;
$mainrecentwork->mainrecentwork_created = date("Y-m-d H:i:s");
$mainrecentwork->mainrecentwork_updated = date("Y-m-d H:i:s");

// Call create function
$query = checkCreate($mainrecentwork);
returnSuccess($mainrecentwork, 'mainrecentwork create', $query);
