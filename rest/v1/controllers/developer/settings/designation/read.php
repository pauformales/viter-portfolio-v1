<?php

// check dataase conncetion
$conn = null;
$conn = checkDbConnection();
// make instance of classes or use the model
$designation = new Designation($conn);

if (array_key_exists("designationid", $_GET)) {
    $designation->designation_aid = $_GET['designationid'];
    checkId($designation->designation_aid);
    $query = checkReadById($designation);
    http_response_code(200);
    getQueriedData($query);
}

if (empty($_GET)) {
    $query = checkReadAll($designation);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
