<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-date: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../data/db/database.php';
include_once '../../data/dao/topic_dao.php';
include_once '../../data/entity/topic.php';

$database = new Database();
$db = $database->getConnection();
$topicDao = new TopicDao($db);

$id = isset($_GET['id']) ? $_GET['id'] : die();

$post = $topicDao->getSingleTopic($id);

if ($post != null) {
    if ($topicDao->deleteTopic($id)) {
        echo json_encode("Topic deleted.");
    } else {
        echo json_encode("Topic could not be deleted");
    }
} else {
    http_response_code(404);
    echo json_encode("Topic not found, data could not be deleted.");
}
?>