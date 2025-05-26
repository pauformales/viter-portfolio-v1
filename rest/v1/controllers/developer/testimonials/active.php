<?php
// set http header
require '../../../core/header.php';
// use needed function
require '../../../core/functions.php';
require './function.php';

// use model
require '../../../models/developer/testimonials/MainTestimonials.php';


// check database connection
$conn = null;
$conn = checkDbConnection();
// store model in variable
$maintestimonials = new Maintestimonials($conn);
// get payload
$body = file_get_contents("php://input");
$data = json_decode($body, true);

// VALIDATE API KEY
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    if (array_key_exists('maintestimonialsid', $_GET)) {
        //CHECK DATA
        checkPayload($data);
        $maintestimonials->maintestimonials_aid = $_GET['maintestimonialsid'];
        $maintestimonials->maintestimonials_is_active = trim($data['isActive']);
        $maintestimonials->maintestimonials_updated = date('Y-m-d H:i:s');


        checkId($maintestimonials->maintestimonials_aid);
        $query = checkActive($maintestimonials);
        returnSuccess($maintestimonials, 'maintestimonials active', $query);
    }

    // 404 if endpoint not available
    checkEndpoint();
}
