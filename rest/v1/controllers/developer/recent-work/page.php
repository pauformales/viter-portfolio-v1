<?php
// set http header


require '.././../../core/header.php';

// use needed function

require '.././../../core/functions.php';
// use needed models

require '.././../../models/developer/recent-work/MainRecentWork.php';


$conn = null;
$conn = checkDbConnection();


$mainrecentwork = new Mainrecentwork($conn);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    if (array_key_exists('start', $_GET)) {
        $mainrecentwork->start = $_GET['start'];
        $mainrecentwork->total = 3;

        $query = checkReadLimit($mainrecentwork);
        $total_result = checkReadAll($mainrecentwork);
        http_response_code(200);

        checkReadQuery(
            $query,
            $total_result,
            $mainrecentwork->total,
            $mainrecentwork->start
        );
    }

    checkEndpoint();
}
