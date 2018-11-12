<?php

namespace AndyFranklin\CVBundle\DataManager;

/**
 * Class Experience
 * @package AndyFranklin\CVBundle\DataManager
 */
class Experience
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
     * Experience constructor.
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
     * @return Experience
     */
    public function setTitle(string $title): Experience
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
     * @return Experience
     */
    public function setDescription(string $description): Experience
    {
        $this->description = $description;
        return $this;
    }
}