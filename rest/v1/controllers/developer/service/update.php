<?php

//CHECK DATABASE CONNECTION

$conn = null;
$conn = checkDbConnection();


//USE MODELS
$mainservice = new Mainservice($conn);


$body = file_get_contents("php://input");
$data = json_decode($body, true);


if (array_key_exists('mainserviceid', $_GET)) {
    // check data
    checkPayload($data);
    // CHECKING DATA
    $mainservice->mainservice_aid = $_GET['mainserviceid'];
    $mainservice->mainservice_title = $data['mainservice_title'];
    $mainservice->mainservice_description = $data['mainservice_description'];
    $mainservice->mainservice_updated = date('Y-m-d H:i:s');

    $mainservice_title_old = checkIndex($data, 'mainservice_title_old');

    // VALIDATION
    checkId($mainservice->mainservice_aid);

    compareTitle($mainservice, $mainservice->mainservice_title, $mainservice_title_old);

    $query = checkUpdate($mainservice);
    returnSuccess($mainservice, 'mainservice update', $query);
}

// exit if not available

checkEndPoint();
