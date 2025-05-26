<?php
// set http header


require '.././../../core/header.php';

// use needed function

require '.././../../core/functions.php';
// use needed models

require '.././../../models/developer/about/MainAbout.php';


$conn = null;
$conn = checkDbConnection();


$mainabout = new Mainabout($conn);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    if (array_key_exists('start', $_GET)) {
        $mainabout->start = $_GET['start'];
        $mainabout->total = 3;

        $query = checkReadLimit($mainabout);
        $total_result = checkReadAll($mainabout);
        http_response_code(200);

        checkReadQuery(
            $query,
            $total_result,
            $mainabout->total,
            $mainabout->start
        );
    }

    checkEndpoint();
}
