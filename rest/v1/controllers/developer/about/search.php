<?php

require '../../../core/header.php';
require '../../../core/functions.php';
require './function.php';
require '../../../models/developer/about/MainAbout.php';

$conn = null;
$conn = checkDbConnection();

$mainabout = new Mainabout($conn);

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    checkPayload($data);

    $mainabout->search = $data['searchValue'];

    if ($data['isFilter']) {
        $mainabout->mainabout_is_active = $data['isActive'];
        http_response_code(200);
        if ($mainabout->search != '') {
            $query = checkFilterSearch($mainabout);
            getQueriedData($query);
        }

        $query = checkFilter($mainabout);
        getQueriedData($query);
    }

    $query = checkSearch($mainabout);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
