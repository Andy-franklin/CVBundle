<?php

namespace AndyFranklin\CVBundle\DataManager;

/**
 * Class Interest
 * @package AndyFranklin\CVBundle\DataManager
 */
class Interest
{
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;

    /**
     * Interest constructor.
     * @param string $title
     * @param string $description
     */
    public function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Interest
     */
    public function setTitle(string $title): Interest
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Interest
     */
    public function setDescription(string $description): Interest
    {
        $this->description = $description;
        return $this;
    }
}