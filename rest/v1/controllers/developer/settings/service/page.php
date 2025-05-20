<?php
// set http header
require '../../../../core/header.php';

// use needed function
require '../../../../core/functions.php';
// use needed models
require '../../../../models/developer/settings/service/Service.php';


$conn = null;
$conn = checkDbConnection();


$service = new Service($conn);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    if (array_key_exists('start', $_GET)) {
        $service->start = $_GET['start'];
        $service->total = 3;

        $query = checkReadLimit($service);
        $total_result = checkReadAll($service);
        http_response_code(200);

        checkReadQuery(
            $query,
            $total_result,
            $service->total,
            $service->start
        );
    }

    checkEndpoint();
}
