<?php

namespace AndyFranklin\CVBundle\DependencyInjection;

use AndyFranklin\CVBundle\DataManager\CVInfo;
use AndyFranklin\CVBundle\DataManager\Experience;
use AndyFranklin\CVBundle\DataManager\Interest;
use AndyFranklin\CVBundle\DataManager\Skill;
use AndyFranklin\CVBundle\DataManager\SocialLink;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class AndyFranklinCVExtension
 * @package AndyFranklin\CVBundle\DependencyInjection
 */
class AndyFranklinCVExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        //Set configuration strings
        $container->getDefinition(CVInfo::class)->addMethodCall('setName', [$config['name']]);
        $container->getDefinition(CVInfo::class)->addMethodCall('setJobTitle', [$config['job_title']]);
        $container->getDefinition(CVInfo::class)->addMethodCall('setWorkPlace', [$config['work_place']]);
        $container->getDefinition(CVInfo::class)->addMethodCall('setSummary', [$config['summary']]);

        foreach ($config['social_links'] as $socialLinkConfig) {
            $socialLinkDefinition = new Definition(SocialLink::class, [$socialLinkConfig['type'], $socialLinkConfig['link']]);
            $container->getDefinition(CVInfo::class)->addMethodCall('addSocialLink', [$socialLinkDefinition]);
        }

        foreach ($config['experiences'] as $experienceConfig) {
            $experienceDefinition = new Definition(Experience::class, [$experienceConfig['title'], $experienceConfig['description']]);
            $container->getDefinition(CVInfo::class)->addMethodCall('addExperience', [$experienceDefinition]);
        }

        foreach ($config['skills'] as $skillConfig) {
            $skillDefinition = new Definition(Skill::class, [$skillConfig['title'], $skillConfig['description']]);
            $container->getDefinition(CVInfo::class)->addMethodCall('addSkill', [$skillDefinition]);
        }

        foreach ($config['interests'] as $interestConfig) {
            $interestDefinition = new Definition(Interest::class, [$interestConfig['title'], $interestConfig['description']]);
            $container->getDefinition(CVInfo::class)->addMethodCall('addInterest', [$interestDefinition]);
        }
    }
}
