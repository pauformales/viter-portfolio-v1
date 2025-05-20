<?php 

$conn = null;
$conn = checkDbConnection();

$experience = new Experience($conn);

if(array_key_exists('experienceid', $_GET)){

    $experience->experience_aid = $_GET['experienceid'];
    checkId($experience->experience_aid);


    $query = checkDelete($experience);
    returnSuccess($experience, 'experience delete', $query);
}

checkEndpoint();