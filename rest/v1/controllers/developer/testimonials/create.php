<?php

$connection = null;
$conn = checkDbConnection(); // Check DB connection

// Create instance of the MaintestimonialsList model
$maintestimonials = new Maintestimonials($conn);

// GET method should not be used here
if (array_key_exists("maintestimonialsid", $_GET)) {
    checkEndpoint(); // Deny access if 'maintestimonialsid' is passed via GET
}

// Check if payload has value
checkPayload($data);

// Assign and validate input data


$maintestimonials->maintestimonials_first_name = checkIndex($data, 'maintestimonials_first_name');
$maintestimonials->maintestimonials_last_name = checkIndex($data, 'maintestimonials_last_name');
$maintestimonials->maintestimonials_email = checkIndex($data, 'maintestimonials_email');
$maintestimonials->maintestimonials_description = checkIndex($data, 'maintestimonials_description');

// Set timestamps and status
$maintestimonials->maintestimonials_is_active = 1;
$maintestimonials->maintestimonials_created = date("Y-m-d H:i:s");
$maintestimonials->maintestimonials_updated = date("Y-m-d H:i:s");

// Call create function
$query = checkCreate($maintestimonials);
returnSuccess($maintestimonials, 'maintestimonials create', $query);
