<?php
// set http header


require '.././../../core/header.php';

// use needed function

require '.././../../core/functions.php';
// use needed models

require '.././../../models/developer/testimonials/MainTestimonials.php';


$conn = null;
$conn = checkDbConnection();


$maintestimonials = new Maintestimonials($conn);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    if (array_key_exists('start', $_GET)) {
        $maintestimonials->start = $_GET['start'];
        $maintestimonials->total = 3;

        $query = checkReadLimit($maintestimonials);
        $total_result = checkReadAll($maintestimonials);
        http_response_code(200);

        checkReadQuery(
            $query,
            $total_result,
            $maintestimonials->total,
            $maintestimonials->start
        );
    }

    checkEndpoint();
}
