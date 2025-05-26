<?php

$conn = null;
$conn = checkDbConnection();

$maintestimonials = new Maintestimonials($conn);

if (array_key_exists('maintestimonialsid', $_GET)) {

    $maintestimonials->maintestimonials_aid = $_GET['maintestimonialsid'];
    checkId($maintestimonials->maintestimonials_aid);


    $query = checkDelete($maintestimonials);
    returnSuccess($maintestimonials, 'maintestimonials delete', $query);
}

checkEndpoint();
