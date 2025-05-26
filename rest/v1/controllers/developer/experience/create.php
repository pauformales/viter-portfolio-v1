<?php

$connection = null;
$conn = checkDbConnection(); // Check DB connection

// Create instance of the ExperienceList model
$mainexperience = new MainExperience($conn);

// GET method should not be used here
if (array_key_exists("mainexperienceid", $_GET)) {
    checkEndpoint(); // Deny access if 'experienceid' is passed via GET
}

// Check if payload has value
checkPayload($data);

// Assign and validate input data
$mainexperience->mainexperience_title = checkIndex($data, 'mainexperience_title');
$mainexperience->mainexperience_category = checkIndex($data, 'mainexperience_category');
$mainexperience->mainexperience_description = checkIndex($data, 'mainexperience_description');


// Set timestamps and status
$mainexperience->mainexperience_is_active = 1;
$mainexperience->mainexperience_created = date("Y-m-d H:i:s");
$mainexperience->mainexperience_updated = date("Y-m-d H:i:s");

isTitleExist($mainexperience, $mainexperience->mainexperience_title);

// Call create function
$query = checkCreate($mainexperience);
returnSuccess($mainexperience, 'mainexperience create', $query);
