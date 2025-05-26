<?php

// check dataase conncetion
$conn = null;
$conn = checkDbConnection();
// make instance of classes or use the model
$mainexperience = new MainExperience($conn);

if (array_key_exists("mainexperienceid", $_GET)) {
    $mainexperience->mainexperience_aid = $_GET['mainexperienceid'];
    checkId($mainexperience->mainexperience_aid);
    $query = checkReadById($mainexperience);
    http_response_code(200);
    getQueriedData($query);
}

if (empty($_GET)) {
    $query = checkReadAll($mainexperience);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
