<?php


$conn = null;
$conn = checkDbConnection();

$designation = new Designation($conn);

$body = file_get_contents("php://input");


if (array_key_exists('designationid', $_GET)) {
    $designation->designation_aid = $_GET['designationid'];
    checkId($designation->designation_aid);
    $query = checkDelete($designation);
    returnSuccess($designation, 'designation delete', $query);
}
