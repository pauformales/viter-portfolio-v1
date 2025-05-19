<?php

require '../../../core/header.php';
require '../../../core/functions.php';
require 'functions.php';
require '../../../models/developer/children-list/ChildrenList.php';

$conn = null;
$conn = checkDbConnection();

$childrenList = new ChildrenList($conn);

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    checkPayload($data);

    $childrenList->search = $data['searchValue'];

    if ($data['isFilter']) {
        $childrenList->children_list_is_active = $data['isActive'];
        http_response_code(200);
        if ($childrenList->search != '') {
            $query = checkFilterSearch($childrenList);
            getQueriedData($query);
        }

        $query = checkFilter($childrenList);
        getQueriedData($query);
    }

    $query = checkSearch($childrenList);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
