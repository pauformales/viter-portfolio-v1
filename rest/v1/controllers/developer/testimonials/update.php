<?php

//CHECK DATABASE CONNECTION

$conn = null;
$conn = checkDbConnection();
//USE MODELS
$maintestimonials = new Maintestimonials($conn);

if (array_key_exists('maintestimonialsid', $_GET)) {
    // check data
    checkPayload($data);
    // CHECKING DATA
    $maintestimonials->maintestimonials_aid = $_GET['maintestimonialsid'];
    $maintestimonials->maintestimonials_first_name = checkIndex($data, 'maintestimonials_first_name');
    $maintestimonials->maintestimonials_last_name = checkIndex($data, 'maintestimonials_last_name');
    $maintestimonials->maintestimonials_email = checkIndex($data, 'maintestimonials_email');
    $maintestimonials->maintestimonials_description = checkIndex($data, 'maintestimonials_description');
    $maintestimonials->maintestimonials_is_active = 1;
    $maintestimonials->maintestimonials_created = date("Y-m-d H:i:s");
    $maintestimonials->maintestimonials_updated = date("Y-m-d H:i:s");


    // VALIDATION
    checkId($maintestimonials->maintestimonials_aid);


    $query = checkUpdate($maintestimonials);
    returnSuccess($maintestimonials, 'portfolio list update', $query);
}

// exit if not available

checkEndPoint();
