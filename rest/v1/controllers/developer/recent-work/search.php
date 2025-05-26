<?php

require '../../../core/header.php';
require '../../../core/functions.php';
require './function.php';
require '../../../models/developer/recent-work/MainRecentWork.php';

$conn = null;
$conn = checkDbConnection();

$mainrecentwork = new Mainrecentwork($conn);

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    checkPayload($data);

    $mainrecentwork->search = $data['searchValue'];

    if ($data['isFilter']) {
        $mainrecentwork->mainrecentwork_is_active = $data['isActive'];
        http_response_code(200);
        if ($mainrecentwork->search != '') {
            $query = checkFilterSearch($mainrecentwork);
            getQueriedData($query);
        }

        $query = checkFilter($mainrecentwork);
        getQueriedData($query);
    }

    $query = checkSearch($mainrecentwork);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
