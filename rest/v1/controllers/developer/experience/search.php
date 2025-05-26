<?php

require '../../../core/header.php';
require '../../../core/functions.php';
require 'functions.php';
require '../../../models/developer/experience/MainExperience.php';


$conn = null;
$conn = checkDbConnection();

$mainexperience = new MainExperience($conn);

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    checkPayload($data);

    $mainexperience->mainexperience_search = $data['searchValue'];

    if ($data['isFilter']) {
        $mainexperience->mainexperience_is_active = $data['isActive'];
        http_response_code(200);
        if ($mainexperience->mainexperience_search != '') {
            $query = checkFilterSearch($mainexperience);
            getQueriedData($query);
        }

        $query = checkFilter($mainexperience);
        getQueriedData($query);
    }

    $query = checkSearch($mainexperience);
    http_response_code(200);
    getQueriedData($query);
    
}



checkEndPoint();
