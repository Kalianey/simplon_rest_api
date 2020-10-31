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

$id = isset($_GET['id']) ? $_GET['id'] : die();

$post = $postDao->getSinglePost($id);

if ($post != null) {
    if ($postDao->deletePost($id)) {
        echo json_encode("Post deleted.");
    } else {
        echo json_encode("Topic could not be deleted");
    }
} else {
    http_response_code(404);
    echo json_encode("Post not found, data could not be deleted.");
}
?>