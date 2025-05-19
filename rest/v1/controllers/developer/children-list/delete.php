<?php


$conn = null;
$conn = checkDbConnection();

$childrenList = new ChildrenList($conn);

$body = file_get_contents("php://input");


if (array_key_exists('childrenListid', $_GET)) {
    $childrenList->children_list_aid = $_GET['childrenListid'];
    checkId($childrenList->children_list_aid);
    $query = checkDelete($childrenList);
    returnSuccess($childrenList, 'children delete', $query);
}
