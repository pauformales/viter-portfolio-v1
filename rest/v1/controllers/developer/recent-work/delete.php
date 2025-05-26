<?php

$conn = null;
$conn = checkDbConnection();

$mainrecentwork = new Mainrecentwork($conn);

if (array_key_exists('mainrecentworkid', $_GET)) {

    $mainrecentwork->mainrecentwork_aid = $_GET['mainrecentworkid'];
    checkId($mainrecentwork->mainrecentwork_aid);


    $query = checkDelete($mainrecentwork);
    returnSuccess($mainrecentwork, 'mainrecentwork delete', $query);
}

checkEndpoint();
