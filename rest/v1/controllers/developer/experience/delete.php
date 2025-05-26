<?php


$conn = null;
$conn = checkDbConnection();

$mainexperience = new MainExperience($conn);

$body = file_get_contents("php://input");


if (array_key_exists('mainexperienceid', $_GET)) {
    $mainexperience->mainexperience_aid = $_GET['mainexperienceid'];
    checkId($mainexperience->mainexperience_aid);

    $query = checkDelete($mainexperience);
    returnSuccess($mainexperience, 'mainexperience delete', $query);
}

checkEndPoint();
