<?php

// check database connection
$conn = null;
$conn = checkDbConnection();

// make instance of classes or use the model
$mainrecentwork = new Mainrecentwork($conn);

if (array_key_exists("mainrecentworkid", $_GET)) {
    $mainrecentworkid->mainrecentwork_id = $_GET['mainrecentworkid'];
    checkId($mainrecentwork->mainrecentwork_aid);
    $query = checkReadById($mainrecentwork);
    http_response_code(200);
    getQueriedData($query);
}

if (empty($_GET)) {
    $query = checkReadAll($mainrecentwork);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();
