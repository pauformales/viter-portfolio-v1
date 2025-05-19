<?php


$conn = null;
$conn = checkDbConnection();

$donorList = new DonorList($conn);

$body = file_get_contents("php://input");


if (array_key_exists('donorListid', $_GET)) {
    $donorList->donor_list_aid = $_GET['donorListid'];
    checkId($donorList->donor_list_aid);
    $query = checkDelete($donorList);
    returnSuccess($donorList, 'donor delete', $query);
}
