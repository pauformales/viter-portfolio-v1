<?php

$conn = null;
$conn = checkDbConnection();
// MAKE INSTANCE OF A CLASS
$notification = new Notification($conn);

//  GET METHOD REQUEST SHOULD NOT BE PRESENT IN THIS REQUEST
if (array_key_exists("notificationid", $_GET)) {
    checkEndpoint();
}
// CHECK IF DATA HAS VALUE
checkPayload($data);
// GET DATA
$notification->notification_name = checkIndex($data, 'notification_name');
$notification->notification_email = checkIndex($data, 'notification_email');
$notification->notification_purpose = checkIndex($data, 'notification_purpose');
$notification->notification_is_active = 1;
$notification->notification_created = date("Y-m-d H:i:s");
$notification->notification_updated = date("Y-m-d H:i:s");

// VALIDATION
isNameExist($notification, $notification->notification_name);

$query = checkCreate($notification);
returnSuccess($notification, 'notification create', $query);
