<?php

//CHECK DATABASE CONNECTION

$conn = null;
$conn = checkDbConnection();
//USE MODELS
$childrenList = new ChildrenList($conn);

if (array_key_exists('childrenListid', $_GET)) {
    // check data
    checkPayload($data);
    // CHECKING DATA
    $childrenList->children_list_aid = $_GET['childrenListid'];
    $childrenList->children_list_first_name = checkIndex($data, 'children_list_first_name');
    $childrenList->children_list_last_name = checkIndex($data, 'children_list_last_name');
    $childrenList->children_list_birthdate = checkIndex($data, 'children_list_birthdate');
    $childrenList->children_list_age = $data['children_list_age'];
    $childrenList->children_list_donation = $data['children_list_donation'];
    $childrenList->children_list_story = $data['children_list_story'];
    $childrenList->children_list_is_active = 1;
    $childrenList->children_list_created = date("Y-m-d H:i:s");
    $childrenList->children_list_updated = date("Y-m-d H:i:s");

    $children_list_first_name_old = checkIndex($data, 'children_list_first_name_old');
    $children_list_last_name_old = checkIndex($data, 'children_list_last_name_old');
    $fullname_new = "{$childrenList->children_list_first_name} {$childrenList->children_list_last_name}";
    $fullname_old = "{$children_list_first_name_old} {$children_list_last_name_old}";

    // VALIDATION
    checkId($childrenList->children_list_aid);

    compareName($childrenList, $fullname_new, $fullname_old);

    $query = checkUpdate($childrenList);
    returnSuccess($childrenList, 'children list update', $query);
}

// exit if not available

checkEndPoint();
