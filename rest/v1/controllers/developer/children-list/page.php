<?php

require_once '../../../core/header.php';
require_once '../../../core/functions.php';
require '../../../models/developer/children-list/ChildrenList.php';

$conn = null;
$conn = checkDbConnection();

$childrenList = new ChildrenList($conn);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    if (array_key_exists('start', $_GET)) {
        $childrenList->start = $_GET['start'];
        $childrenList->total = 3 ;

        $query = checkReadLimit($childrenList);
        $total_result = checkReadAll($childrenList);
        http_response_code(200);

        checkReadQuery(
            $query,
            $total_result,
            $childrenList->total,
            $childrenList->start
        );
    }
}

checkEndPoint();
