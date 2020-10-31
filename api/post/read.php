<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../data/db/database.php';
include_once '../../data/dao/post_dao.php';
include_once '../../data/entity/post.php';
include_once '../../data/dao/topic_dao.php';
include_once '../../data/entity/topic.php';

$database = new Database();
$db = $database->getConnection();
$postDao = new PostDao($db);
$topicDao = new TopicDao($db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $post = $postDao->getSinglePost($id);

    if ($post != null) {

        $topic = $topicDao->getSingleTopic($post->getTopicID());

        $emp_arr = array(
            "id" => $post->getId(),
            "content" => $post->getContent(),
            "author" => $post->getAuthor(),
            "date" => $post->getDate(),
            "topicID" => $post->getTopicID(),
            "topicTitle" => $topic->getTitle()
        );

        http_response_code(200);
        echo json_encode($emp_arr);
    } else {
        http_response_code(404);
        echo json_encode("Post not found.");
    }
} else {
    $stmt = $postDao->getPosts();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {

        $postArr = array();
        $postArr["items"] = array();
        $postArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $topic = $topicDao->getSingleTopic($topicID);
            $e = array(
                "id" => $id,
                "content" => $content,
                "author" => $author,
                "date" => $date,
                "topicID" => $topicID,
                "topicTitle" => $topic->getTitle()
            );

            array_push($postArr["items"], $e);
        }
        echo json_encode($postArr);
    } else {
        http_response_code(404);
        echo json_encode("No post found.");
    }
}
?>