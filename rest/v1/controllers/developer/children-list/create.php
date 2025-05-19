<?php
$conn = null;
$conn = checkDbConnection();
// MAKE INSTANCE OF A CLASS
$childrenList = new ChildrenList($conn);

//  GET METHOD REQUEST SHOULD NOT BE PRESENT IN THIS REQUEST
if (array_key_exists("childrenListid", $_GET)) {
    checkEndpoint();
}
// CHECK IF DATA HAS VALUE
checkPayload($data);
// GET DATA
$childrenList->children_list_first_name = checkIndex($data, 'children_list_first_name');
$childrenList->children_list_last_name = checkIndex($data, 'children_list_last_name');
$childrenList->children_list_birthdate = checkIndex($data, 'children_list_birthdate');
$childrenList->children_list_age = $data['children_list_age'];
$childrenList->children_list_donation = checkIndex($data, 'children_list_donation');
$childrenList->children_list_story = $data['children_list_story'];
$childrenList->children_list_is_active = 1;
$childrenList->children_list_created = date("Y-m-d H:i:s");
$childrenList->children_list_updated = date("Y-m-d H:i:s");

$fullname = "{$childrenList->children_list_first_name} {$childrenList->children_list_last_name}";

// VALIDATION

isNameExist($childrenList, $fullname);

$query = checkCreate($childrenList);
returnSuccess($childrenList, 'childrenList create', $query);
