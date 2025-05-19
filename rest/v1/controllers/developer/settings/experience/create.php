<?php

$conn = null;
$conn = checkDbConnection();
// MAKE INSTANCE OF A CLASS
$experience = new Experience($conn);

//  GET METHOD REQUEST SHOULD NOT BE PRESENT IN THIS REQUEST
if (array_key_exists("experienceid", $_GET)) {
    checkEndpoint();
}
// CHECK IF DATA HAS VALUE
checkPayload($data);
// GET DATA
$experience->experience_title = checkIndex($data, 'experience_title');
$experience->experience_description = checkIndex($data, 'experience_description');
$experience->experience_is_active = 1;
$experience->experience_created = date("Y-m-d H:i:s");
$experience->experience_updated = date("Y-m-d H:i:s");

// VALIDATION
isTitleExist($experience, $experience->experience_title);

$query = checkCreate($experience);
returnSuccess($experience, 'experience create', $query);
