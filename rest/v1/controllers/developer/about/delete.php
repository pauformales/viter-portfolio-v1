<?php

$conn = null;
$conn = checkDbConnection();

$mainabout = new Mainabout($conn);

if (array_key_exists('mainaboutid', $_GET)) {

    $mainabout->mainabout_aid = $_GET['mainaboutid'];
    checkId($mainabout->mainabout_aid);


    $query = checkDelete($mainabout);
    returnSuccess($mainabout, 'mainabout delete', $query);
}

checkEndpoint();
