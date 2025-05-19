<?php


$conn = null;
$conn = checkDbConnection();

$experience = new Experience($conn);

$body = file_get_contents("php://input");


if (array_key_exists('experienceid', $_GET)) {
    $experience->experience_aid = $_GET['experienceid'];
    checkId($experience->experience_aid);



    $query = checkDelete($experience);
    returnSuccess($experience, 'experience delete', $query);
}

checkEndPoint();
