<?php

require '../../../core/header.php';
require '../../../core/functions.php';
require 'functions.php';
require '../../../models/developer/donor-list/DonorList.php';

$conn = null;
$conn = checkDbConnection();

$donorList = new DonorList($conn);

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    checkPayload($data);

    $donorList->search = $data['searchValue'];

    if ($data['isFilter']) {
        $donorList->donor_list_is_active = $data['isActive'];
        http_response_code(200);
        if ($donorList->search != '') {
            $query = checkFilterSearch($donorList);
            getQueriedData($query);
        }

        $query = checkFilter($donorList);
        getQueriedData($query);
    }

    $query = checkSearch($donorList);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
