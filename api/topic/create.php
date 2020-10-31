<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-date: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../data/db/database.php';
include_once '../../data/dao/topic_dao.php';
include_once '../../data/entity/topic.php';
include_once '../../data/dao/post_dao.php';
include_once '../../data/entity/post.php';

$database = new Database();
$db = $database->getConnection();
$topicDao = new TopicDao($db);
$postDao = new PostDao($db);

$data = json_decode(file_get_contents("php://input"));

if (! isset($data->title) || ! isset($data->content) || ! isset($data->author)) {
    echo json_encode("Title, content and author fields should not be empty.");
} else {

    $topic = new Topic($data->title);
    $topicID = $topicDao->createTopic($topic);

    if ($topicID != null) {
        $post = new Post($data->content, $data->author, date('Y-m-d H:i:s'), $topicID);

        if ($postDao->createPost($post)) {
            echo json_encode("Topic created successfully.");
        } else {
            echo json_encode("Topic could not be created.");
        }
    } else {
        echo json_encode("Topic could not be created.");
    }
}

?>