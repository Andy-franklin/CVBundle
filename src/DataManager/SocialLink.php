<?php

namespace AndyFranklin\CVBundle\DataManager;

/**
 * Class SocialLink
 * @package AndyFranklin\CVBundle\DataManager
 */
class SocialLink
{
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $link;

    /**
     * SocialLink constructor.
     * @param string $type
     * @param string $link
     */
    public function __construct(string $type, string $link)
    {
        $this->type = $type;
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return SocialLink
     */
    public function setType(string $type): SocialLink
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return SocialLink
     */
    public function setLink(string $link): SocialLink
    {
        $this->link = $link;
        return $this;
    }
}