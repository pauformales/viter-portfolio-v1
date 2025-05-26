<?php

// check database connection
$conn = null;
$conn = checkDbConnection();

// make instance of classes or use the model
$maintestimonials = new Maintestimonials($conn);

if (array_key_exists("maintestimonialsid", $_GET)) {
    $maintestimonialsid->maintestimonials_id = $_GET['maintestimonialsid'];
    checkId($maintestimonials->maintestimonials_aid);
    $query = checkReadById($maintestimonials);
    http_response_code(200);
    getQueriedData($query);
}

if (empty($_GET)) {
    $query = checkReadAll($maintestimonials);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();
