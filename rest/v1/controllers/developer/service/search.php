<?php

require '../../../core/header.php';
require '../../../core/functions.php';
require 'functions.php';
require '../../../models/developer/service/MainService.php';

$conn = null;
$conn = checkDbConnection();

$mainservice = new MainService($conn);

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    checkPayload($data);

    $mainservice->mainservice_search = $data['searchValue'];

    if ($data['isFilter']) {
        $mainservice->mainservice_is_active = $data['isActive'];
        http_response_code(200);
        if ($mainservice->mainservice_search != '') {
            $query = checkFilterSearch($mainservice);
            getQueriedData($query);
        }

        $query = checkFilter($mainservice);
        getQueriedData($query);
    }

    $query = checkSearch($mainservice);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
