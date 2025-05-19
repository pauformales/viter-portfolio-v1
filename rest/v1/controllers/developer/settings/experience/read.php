<?php

// check dataase conncetion
$conn = null;
$conn = checkDbConnection();
// make instance of classes or use the model
$experience = new Experience($conn);

if (array_key_exists("experienceid", $_GET)) {
    $experience->experience_aid = $_GET['experienceid'];
    checkId($experience->experience_aid);
    $query = checkReadById($experience);
    http_response_code(200);
    getQueriedData($query);
}

if (empty($_GET)) {
    $query = checkReadAll($experience);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
