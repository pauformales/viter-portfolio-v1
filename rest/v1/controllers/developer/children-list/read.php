<?php

// check dataase conncetion
$conn = null;
$conn = checkDbConnection();
// make instance of classes or use the model
$childrenList = new ChildrenList($conn);

if (array_key_exists("childrenListid", $_GET)) {
    $childrenList->children_list_aid = $_GET['childrenListid'];
    checkId($childrenList->children_list_aid);
    $query = checkReadById($childrenList);
    http_response_code(200);
    getQueriedData($query);
}

if (empty($_GET)) {
    $query = checkReadAll($childrenList);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
