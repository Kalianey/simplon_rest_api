<?php

class PostDao
{

    private $connexion;

    private $db_table = "post";

    // DB connection
    public function __construct($db)
    {
        $this->connexion = $db;
    }

    // CREATE
    public function createPost($item)
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        content = :content, 
                        author = :author, 
                        date = :date, 
                        topicID = :topicID";

        $stmt = $this->connexion->prepare($sqlQuery);

        $content = htmlspecialchars(strip_tags($item->getContent()));
        $author = htmlspecialchars(strip_tags($item->getAuthor()));
        $date = htmlspecialchars(strip_tags($item->getDate()));
        $topicID = htmlspecialchars(strip_tags($item->getTopicID()));

        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":topicID", $topicID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // READ
    public function getPosts()
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . "";
        $stmt = $this->connexion->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // READ SINGLE
    public function getSinglePost($id)
    {
        $sqlQuery = "SELECT
                        *
                      FROM
                        " . $this->db_table . "
                    WHERE
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->connexion->prepare($sqlQuery);

        $stmt->bindParam(1, $id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (! $dataRow) {
            return null;
        } else {
            $item = new Post($dataRow['content'], $dataRow['author'], $dataRow['date'], $dataRow['topicID']);
            $item->setId($dataRow['id']);
            return $item;
        }
    }

    // UPDATE
    public function updatePost($item)
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        content = :content, 
                        author = :author, 
                        date = :date, 
                        topicID = :topicID
                    WHERE 
                        id = :id";

        $stmt = $this->connexion->prepare($sqlQuery);

        $id = $item->getId();
        $content = htmlspecialchars(strip_tags($item->getContent()));
        $author = htmlspecialchars(strip_tags($item->getAuthor()));
        $date = htmlspecialchars(strip_tags($item->getDate()));
        $topicID = htmlspecialchars(strip_tags($item->getTopicID()));

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":topicID", $topicID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    function deletePost($id)
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->connexion->prepare($sqlQuery);

        $this->id = htmlspecialchars(strip_tags($id));

        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>

