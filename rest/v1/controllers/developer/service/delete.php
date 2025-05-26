<?php


$conn = null;
$conn = checkDbConnection();

$mainservice = new MainService($conn);

$body = file_get_contents("php://input");


if (array_key_exists('mainserviceid', $_GET)) {
    $mainservice->mainservice_aid = $_GET['mainserviceid'];
    checkId($mainservice->mainservice_aid);

    $query = checkDelete($mainservice);
    returnSuccess($mainservice, 'mainservice delete', $query);
}

checkEndPoint();
