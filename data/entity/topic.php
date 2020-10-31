<?php

class Topic
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
    private $title;

    public function __construct($title)
    {
        $this->title = $title;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}