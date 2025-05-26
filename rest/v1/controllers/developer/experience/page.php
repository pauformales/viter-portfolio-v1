<?php

require '../../../core/header.php';

require '../../../core/functions.php';


require '../../../models/developer/experience/MainExperience.php';


$conn = null;
$conn = checkDbConnection();

$mainexperience = new MainExperience($conn);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

    if (array_key_exists('start', $_GET)) {
        $mainexperience->mainexperience_start = $_GET['start'];
        $mainexperience->mainexperience_total = 3;

        $query = checkReadLimit($mainexperience);
        $total_result = checkReadAll($mainexperience);
        http_response_code(200);

        checkReadQuery(
            $query,
            $total_result,
            $mainexperience->mainexperience_total,
            $mainexperience->mainexperience_start
        );
    }
}

checkEndPoint();
