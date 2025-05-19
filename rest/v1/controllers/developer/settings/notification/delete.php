<?php


$conn = null;
$conn = checkDbConnection();

$notification = new Notification($conn);

$body = file_get_contents("php://input");


if (array_key_exists('notificationid', $_GET)) {
    $notification->notification_aid = $_GET['notificationid'];
    checkId($notification->notification_aid);
    $query = checkDelete($notification);
    returnSuccess($notification, 'notification delete', $query);
}
