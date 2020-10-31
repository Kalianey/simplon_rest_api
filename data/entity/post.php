<?php

class Post
{

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $content;

    /**
     *
     * @var string
     */
    private $author;

    /**
     *
     * @var string
     */
    private $date;

    /**
     *
     * @var int
     */
    private $topicID;

    public function __construct($content = null, $author = null, $date = null, $topicID = null)
    {
        if ($content != null && $author != null && $date != null && $topicID != null) {
            $this->content = $content;
            $this->author = $author;
            $this->date = $date;
            $this->topicID = $topicID;
        }
    }

    /**
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     *
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     *
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     *
     * @return int
     */
    public function getTopicID()
    {
        return $this->topicID;
    }

    /**
     *
     * @param int $topicID
     */
    public function setTopicID($topicID)
    {
        $this->topicID = $topicID;
    }
}