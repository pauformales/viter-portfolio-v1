<?php

$conn = null;
$conn = checkDbConnection();
// MAKE INSTANCE OF A CLASS
$designation = new Designation($conn);

//  GET METHOD REQUEST SHOULD NOT BE PRESENT IN THIS REQUEST
if (array_key_exists("designationid", $_GET)) {
    checkEndpoint();
}
// CHECK IF DATA HAS VALUE
checkPayload($data);
// GET DATA
$designation->designation_name = checkIndex($data, 'designation_name');
$designation->designation_category_id = checkIndex($data, 'designation_category_id');
$designation->designation_is_active = 1;
$designation->designation_created = date("Y-m-d H:i:s");
$designation->designation_updated = date("Y-m-d H:i:s");

// VALIDATION
isNameExist($designation, $designation->designation_name);

$query = checkCreate($designation);
returnSuccess($designation, 'designation create', $query);
