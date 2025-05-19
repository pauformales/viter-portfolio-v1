<?php

//CHECK DATABASE CONNECTION

$conn = null;
$conn = checkDbConnection();
//USE MODELS
$designation = new Designation($conn);

if (array_key_exists('designationid', $_GET)) {
    // check data
    checkPayload($data);
    // CHECKING DATA
    $designation->designation_aid = $_GET['designationid'];
    $designation->designation_name = checkIndex($data, 'designation_name');
    $designation->designation_category_id = checkIndex($data, 'designation_category_id');
    $designation->designation_updated = date('Y-m-d H:i:s');

    $designation_name_old = $data['designation_name_old'];

    // VALIDATION
    checkId($designation->designation_aid);

    compareName($designation, $designation->$designation_name, $designation_name_old);


    $query = checkUpdate($designation);
    returnSuccess($designation, 'designation update', $query);
}

// exit if not available

checkEndPoint();
