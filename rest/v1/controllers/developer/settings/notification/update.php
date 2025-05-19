<?php

//CHECK DATABASE CONNECTION

$conn = null;
$conn = checkDbConnection();
//USE MODELS
$notification = new Notification($conn);

if (array_key_exists('notificationid', $_GET)) {
    // check data
    checkPayload($data);
    // CHECKING DATA
    $notification->notification_aid = $_GET['notificationid'];
    $notification->notification_name = checkIndex($data, 'notification_name');
    $notification->notification_email = checkIndex($data, 'notification_email');
    $notification->notification_purpose = checkIndex($data, 'notification_purpose');
    $notification->notification_updated = date('Y-m-d H:i:s');

    // VALIDATION
    checkId($notification->notification_aid);

    $query = checkUpdate($notification);
    returnSuccess($notification, 'notification update', $query);
}

// exit if not available

checkEndPoint();
