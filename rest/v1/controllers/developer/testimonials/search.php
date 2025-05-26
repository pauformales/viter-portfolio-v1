<?php

require '../../../core/header.php';
require '../../../core/functions.php';
require './function.php';
require '../../../models/developer/testimonials/MainTestimonials.php';

$conn = null;
$conn = checkDbConnection();

$maintestimonials = new Maintestimonials($conn);

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    checkPayload($data);

    $maintestimonials->search = $data['searchValue'];

    if ($data['isFilter']) {
        $maintestimonials->maintestimonials_is_active = $data['isActive'];
        http_response_code(200);
        if ($maintestimonials->search != '') {
            $query = checkFilterSearch($maintestimonials);
            getQueriedData($query);
        }

        $query = checkFilter($maintestimonials);
        getQueriedData($query);
    }

    $query = checkSearch($maintestimonials);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
