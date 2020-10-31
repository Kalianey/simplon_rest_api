<?php

class TopicDao
{

    private $connexion;

    private $db_table = "topic";

    // DB connection
    public function __construct($db)
    {
        $this->connexion = $db;
    }

    // CREATE
    public function createTopic($item)
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        title = :title";

        $stmt = $this->connexion->prepare($sqlQuery);

        $title = htmlspecialchars(strip_tags($item->getTitle()));
        $stmt->bindParam(":title", $title);

        if ($stmt->execute()) {
            $lastId = $this->connexion->lastInsertId();
            return $lastId;
        }

        return null;
    }

    // READ
    public function getTopics()
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . "";
        $stmt = $this->connexion->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // READ SINGLE
    public function getSingleTopic($id)
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
            $item = new Topic($dataRow['title']);
            $item->setId($dataRow['id']);
            return $item;
        }
    }

    // UPDATE
    public function updateTopic($item)
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        title = :title
                    WHERE 
                        id = :id";

        $stmt = $this->connexion->prepare($sqlQuery);

        $id = $item->getId();
        $title = htmlspecialchars(strip_tags($item->getTitle()));

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    // When we delete a topic, we remove all posts related to it via 'ON DELETE CASCADE' on Post table foreign key
    function deleteTopic($id)
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

