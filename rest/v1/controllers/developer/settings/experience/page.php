<?php
// set http header
require '../../../../core/header.php';

// use needed function
require '../../../../core/functions.php';
// use needed models
require '../../../../models/developer/settings/experience/Experience.php';


$conn = null;
$conn = checkDbConnection();


$experience = new Experience($conn);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    if (array_key_exists('start', $_GET)) {
        $experience->start = $_GET['start'];
        $experience->total = 3;

        $query = checkReadLimit($experience);
        $total_result = checkReadAll($experience);
        http_response_code(200);

        checkReadQuery(
            $query,
            $total_result,
            $experience->total,
            $experience->start
        );
    }

    checkEndpoint();
}
