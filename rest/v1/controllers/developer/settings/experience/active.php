<?php
// set http header
require '../../../../core/header.php';
// use needed function
require '../../../../core/functions.php';
// use model
require '../../../../models/developer/settings/experience/Experience.php';
// check database conection
$conn = null;
$conn = checkDbConnection();
// store model in variable
$experience = new Experience($conn);
// get payload
$body = file_get_contents("php://input");
$data = json_decode($body, true);
// VALIDATE API KEY
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    if (array_key_exists('experienceid', $_GET)) {
        // CHECK DATA
        checkPayload($data);
        $experience->experience_aid = $_GET['experienceid'];
        $experience->experience_is_active = trim($data['isActive']);
        $experience->experience_updated = date('Y-m-d H:i:s');

        checkId($experience->experience_aid);
        $query = checkActive($experience);
        returnSuccess($experience, 'experience active', $query);
    }
    // 404 if endpoint not available
    checkEndPoint();
}
