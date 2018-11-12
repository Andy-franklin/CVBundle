<?php

namespace AndyFranklin\CVBundle\DataManager;

/**
 * Class CVInfo
 * @package AndyFranklin\CVBundle\DataManager
 */
class CVInfo
{
    /**
     * @var string
     */
    private $name = 'Andy Franklin';
    /**
     * @var string
     */
    private $jobTitle = 'Web Developer';
    /**
     * @var string
     */
    private $workPlace = 'The Drum';
    /**
     * @var string
     */
    private $summary = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam lobortis laoreet felis ac rutrum. Vestibulum sodales placerat mauris. Praesent auctor venenatis nunc, nec tempus libero fringilla nec. Suspendisse potenti. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris ac risus lacinia, auctor nisl et, vehicula ligula. Vivamus pellentesque eu nulla non ultricies. Donec commodo ex eget sem condimentum viverra.';
    /**
     * @var array
     */
    private $socialLinks = [];
    /**
     * @var array
     */
    private $experiences = [];
    /**
     * @var array
     */
    private $skills = [];
    /**
     * @var array
     */
    private $interests = [];

    /**
     * @return string
     */
    public function getJobTitle(): string
    {
        return $this->jobTitle;
    }

    /**
     * @param string $jobTitle
     * @return CVInfo
     */
    public function setJobTitle(string $jobTitle): CVInfo
    {
        $this->jobTitle = $jobTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getWorkPlace(): string
    {
        return $this->workPlace;
    }

    /**
     * @param string $workPlace
     * @return CVInfo
     */
    public function setWorkPlace(string $workPlace): CVInfo
    {
        $this->workPlace = $workPlace;
        return $this;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     * @return CVInfo
     */
    public function setSummary(string $summary): CVInfo
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @return array
     */
    public function getSocialLinks(): array
    {
        return $this->socialLinks;
    }

    /**
     * @param SocialLink $socialLink
     * @return CVInfo
     */
    public function addSocialLink(SocialLink $socialLink): CVInfo
    {
        $this->socialLinks[] = $socialLink;
        return $this;
    }

    /**
     * @return array
     */
    public function getExperiences(): array
    {
        return $this->experiences;
    }

    /**
     * @param Experience $experience
     * @return CVInfo
     */
    public function addExperience(Experience $experience): CVInfo
    {
        $this->experiences[] = $experience;
        return $this;
    }

    /**
     * @return array
     */
    public function getSkills(): array
    {
        return $this->skills;
    }

    /**
     * @param Skill $skill
     * @return CVInfo
     */
    public function addSkill(Skill $skill): CVInfo
    {
        $this->skills[] = $skill;
        return $this;
    }

    /**
     * @return array
     */
    public function getInterests(): array
    {
        return $this->interests;
    }

    /**
     * @param Interest $interest
     * @return CVInfo
     */
    public function addInterest(Interest $interest): CVInfo
    {
        $this->interests[] = $interest;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CVInfo
     */
    public function setName(string $name): CVInfo
    {
        $this->name = $name;
        return $this;
    }
}
