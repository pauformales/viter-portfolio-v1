<?php

// check dataase conncetion
$conn = null;
$conn = checkDbConnection();
// make instance of classes or use the model
$donorList = new DonorList($conn);

if (array_key_exists("donorListid", $_GET)) {
    $donorList->donor_list_aid = $_GET['donorListid'];
    checkId($donorList->donor_list_aid);
    $query = checkReadById($donorList);
    http_response_code(200);
    getQueriedData($query);
}

if (empty($_GET)) {
    $query = checkReadAll($donorList);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
