<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../data/db/database.php';
include_once '../../data/dao/topic_dao.php';
include_once '../../data/entity/topic.php';

$database = new Database();
$db = $database->getConnection();
$topicDao = new TopicDao($db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $post = $topicDao->getSingleTopic($id);

    if ($post != null) {

        $post_arr = array(
            "id" => $post->getId(),
            "title" => $post->getTitle()
        );

        http_response_code(200);
        echo json_encode($post_arr);
    } else {
        http_response_code(404);
        echo json_encode("Topic not found.");
    }
} else {
    $stmt = $topicDao->getTopics();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {

        $topicArr = array();
        $topicArr["items"] = array();
        $topicArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $e = array(
                "id" => $id,
                "title" => $title
            );

            array_push($topicArr["items"], $e);
        }
        echo json_encode($topicArr);
    } else {
        http_response_code(404);
        echo json_encode("No topic found.");
    }
}
?>