<?php

//CHECK DATABASE CONNECTION

$conn = null;
$conn = checkDbConnection();


//USE MODELS
$mainexperience = new Mainexperience($conn);


$body = file_get_contents("php://input");
$data = json_decode($body, true);


if (array_key_exists('mainexperienceid', $_GET)) {
    // check data
    checkPayload($data);
    // CHECKING DATA
    $mainexperience->mainexperience_aid = $_GET['mainexperienceid'];
    $mainexperience->mainexperience_title = $data['mainexperience_title'];
    $mainexperience->mainexperience_description = $data['mainexperience_description'];
    $mainexperience->mainexperience_updated = date('Y-m-d H:i:s');

    $mainexperience_title_old = checkIndex($data, 'mainexperience_title_old');

    // VALIDATION
    checkId($mainexperience->mainexperience_aid);

    compareTitle($mainexperience, $mainexperience->mainexperience_title, $mainexperience_title_old);

    $query = checkUpdate($mainexperience);
    returnSuccess($mainexperience, 'mainexperience update', $query);
}

// exit if not available

checkEndPoint();
