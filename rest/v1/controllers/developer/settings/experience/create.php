<?php

$connection = null;
$conn = checkDbConnection(); // Check DB connection

// Create instance of the ExperienceList model
$experience = new Experience($conn);

// GET method should not be used here
if (array_key_exists("experienceid", $_GET)) {
    checkEndpoint(); // Deny access if 'experienceid' is passed via GET
}

// Check if payload has value
checkPayload($data);

// Assign and validate input data
$experience->experience_title = checkIndex($data, 'experience_title');
$experience->experience_description = checkIndex($data, 'experience_description');





isTitleExist($experience, $experience->experience_title);



// Set timestamps and status
$experience->experience_is_active = 1;
$experience->experience_created = date("Y-m-d H:i:s");
$experience->experience_updated = date("Y-m-d H:i:s");

// Call create function
$query = checkCreate($experience);
returnSuccess($experience, 'experience create', $query);
