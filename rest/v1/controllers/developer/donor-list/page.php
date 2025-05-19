<?php

require_once '../../../core/header.php';
require_once '../../../core/functions.php';
require '../../../models/developer/donor-list/DonorList.php';

$conn = null;
$conn = checkDbConnection();

$donorList = new DonorList($conn);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    if (array_key_exists('start', $_GET)) {
        $donorList->start = $_GET['start'];
        $donorList->total = 3 ;

        $query = checkReadLimit($donorList);
        $total_result = checkReadAll($donorList);
        http_response_code(200);

        checkReadQuery(
            $query,
            $total_result,
            $donorList->total,
            $donorList->start
        );
    }
}

checkEndPoint();
