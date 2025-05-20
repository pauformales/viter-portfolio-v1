<?php

// set http header
require '../../../../core/header.php';
// use needed function
require '../../../../core/functions.php';
require './function.php';
// use needed models
require '../../../../models/developer/settings/experience/Experience.php';

$conn = null;
$conn = checkDbConnection();


$experience = new Experience($conn);

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    checkPayload($data);

    $experience->search = $data['searchValue'];

    if ($data['isFilter']) {
        $experience->experience_is_active = $data['isActive'];
        http_response_code(200);

        if ($experience->search != '') {
            $query = checkFilterSearch($experience);
            getQueriedData($query);
        }
        $query = checkFilter($experience);
        getQueriedData($query);
    }

    $query = checkSearch($experience);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();
