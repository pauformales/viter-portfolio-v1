<?php
// set http header
require '../../../../core/header.php';
// use needed function
require '../../../../core/functions.php';
// use model
require '../../../../models/developer/settings/notification/Notification.php';
// check database conection
$conn = null;
$conn = checkDbConnection();
// store model in variable
$notification = new Notification($conn);
// get payload
$body = file_get_contents("php://input");
$data = json_decode($body, true);
// VALIDATE API KEY
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    if (array_key_exists('notificationid', $_GET)) {
        // CHECK DATA
        checkPayload($data);
        $notification->notification_aid = $_GET['notificationid'];
        $notification->notification_is_active = trim($data['isActive']);
        $notification->notification_updated = date('Y-m-d H:i:s');

        checkId($notification->notification_aid);
        $query = checkActive($notification);
        returnSuccess($notification, 'notification active', $query);
    }
    // 404 if endpoint not available
    checkEndPoint();
}
