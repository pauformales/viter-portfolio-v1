<?php
$conn = null;
$conn = checkDbConnection();
// MAKE INSTANCE OF A CLASS
$donorList = new DonorList($conn);

//  GET METHOD REQUEST SHOULD NOT BE PRESENT IN THIS REQUEST
if (array_key_exists("donorListid", $_GET)) {
    checkEndpoint();
}
// CHECK IF DATA HAS VALUE
checkPayload($data);
// GET DATA
$donorList->donor_list_first_name = checkIndex($data, 'donor_list_first_name');
$donorList->donor_list_last_name = checkIndex($data, 'donor_list_last_name');
$donorList->donor_list_email = checkIndex($data, 'donor_list_email');
$donorList->donor_list_contact_number = $data['donor_list_contact_number'];
$donorList->donor_list_address = $data['donor_list_address'];
$donorList->donor_list_city = $data['donor_list_city'];
$donorList->donor_list_state_province = $data['donor_list_state_province'];
$donorList->donor_list_country = $data['donor_list_country'];
$donorList->donor_list_zip = $data['donor_list_zip'];
$donorList->donor_list_is_active = 1;
$donorList->donor_list_created = date("Y-m-d H:i:s");
$donorList->donor_list_updated = date("Y-m-d H:i:s");

// VALIDATION
isEmailExist($donorList, $donorList->donor_list_email);

$query = checkCreate($donorList);
returnSuccess($donorList, 'donorList create', $query);
