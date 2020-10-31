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

$data = json_decode(file_get_contents("php://input"));

if ($data->id != null) {

    $post = $topicDao->getSingleTopic($data->id);

    if ($post != null) {

        $post = new Topic($data->title);
        $post->setId($data->id);

        if ($topicDao->updateTopic($post)) {
            echo json_encode("Topic data updated.");
        } else {
            echo json_encode("Data could not be updated");
        }
    } else {
        echo json_encode("Topic not found, data could not be updated.");
    }
} else {
    echo json_encode("Data could not be updated");
}

?>