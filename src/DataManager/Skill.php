<?php

namespace AndyFranklin\CVBundle\DataManager;

/**
 * Class Skill
 * @package AndyFranklin\CVBundle\DataManager
 */
class Skill
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
     * Skill constructor.
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
     * @return Skill
     */
    public function setTitle(string $title): Skill
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
     * @return Skill
     */
    public function setDescription(string $description): Skill
    {
        $this->description = $description;
        return $this;
    }
}