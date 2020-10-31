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

if (! isset($data->content) || ! isset($data->author) || ! isset($data->topicID)) {
    echo json_encode("Content, author and topic fields should not be empty.");
} else {
    $post = new Post($data->content, $data->author, date('Y-m-d H:i:s'), $data->topicID);

    if ($postDao->createPost($post)) {
        echo json_encode("Post created successfully.");
    } else {
        echo json_encode("Post could not be created.");
    }
}

?>