<?php
// set http header
require '../../../core/header.php';
// use needed function
require '../../../core/functions.php';
// use model
require '../../../models/developer/children-list/ChildrenList.php';
// check database conection
$conn = null;
$conn = checkDbConnection();
// store model in variable
$childrenList = new ChildrenList($conn);
// get payload
$body = file_get_contents("php://input");
$data = json_decode($body, true);
// VALIDATE API KEY
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    if (array_key_exists('childrenListid', $_GET)) {
        // CHECK DATA
        checkPayload($data);
        $childrenList->children_list_aid = $_GET['childrenListid'];
        $childrenList->children_list_is_active = trim($data['isActive']);
        $childrenList->children_list_updated = date('Y-m-d H:i:s');

        checkId($childrenList->children_list_aid);
        $query = checkActive($childrenList);
        returnSuccess($childrenList, 'children active', $query);
    }
    // 404 if endpoint not available
    checkEndPoint();
}
