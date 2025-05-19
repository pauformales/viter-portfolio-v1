<?php

// check dataase conncetion
$conn = null;
$conn = checkDbConnection();
// make instance of classes or use the model
$notification = new Notification($conn);

if (array_key_exists("notificationid", $_GET)) {
    $notification->notification_aid = $_GET['notificationid'];
    checkId($notification->notification_aid);
    $query = checkReadById($notification);
    http_response_code(200);
    getQueriedData($query);
}

if (empty($_GET)) {
    $query = checkReadAll($notification);
    http_response_code(200);
    getQueriedData($query);
}

checkEndPoint();
