<?php

//CHECK DATABASE CONNECTION

$conn = null;
$conn = checkDbConnection();
//USE MODELS
$experience = new Experience($conn);

if (array_key_exists('experienceid', $_GET)) {
    // check data
    checkPayload($data);
    // CHECKING DATA
    $experience->experience_aid = $_GET['experienceid'];
    $experience->experience_title = checkIndex($data, 'experience_title');
    $experience->experience_description = checkIndex($data, 'experience_description');
    $experience->experience_updated = date('Y-m-d H:i:s');

    $experience_title_old = $data['experience_title_old'];

    // VALIDATION
    checkId($experience->experience_aid);

    compareTitle($experience, $experience->experience_title, $experience_title_old);

    $query = checkUpdate($experience);
    returnSuccess($experience, 'experience update', $query);
}

// exit if not available

checkEndPoint();
