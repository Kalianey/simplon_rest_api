<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-date: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../data/db/database.php';
include_once '../../data/dao/post_dao.php';
include_once '../../data/entity/post.php';

$database = new Database();
$db = $database->getConnection();
$postDao = new PostDao($db);

$data = json_decode(file_get_contents("php://input"));

if ($data->id != null) {

    $post = $postDao->getSinglePost($data->id);

    if ($post != null) {

        $post = new Post($data->content, $data->author, date('Y-m-d H:i:s'), $data->topicID);
        $post->setId($data->id);

        if ($postDao->updatePost($post)) {
            echo json_encode("Post data updated.");
        } else {
            echo json_encode("Data could not be updated");
        }
    } else {
        echo json_encode("Post not found, data could not be updated.");
    }
} else {
    echo json_encode("Data could not be updated");
}

?>