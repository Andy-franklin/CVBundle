<?php

namespace AndyFranklin\CVBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('andy_franklin_cv');

        $rootNode
            ->children()
                ->scalarNode('name')->end()
                ->scalarNode('job_title')->end()
                ->scalarNode('work_place')->end()
                ->scalarNode('summary')->end()
                ->arrayNode('social_links')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('type')->end()
                            ->scalarNode('link')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('experiences')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('title')->end()
                            ->scalarNode('location')->end()
                            ->scalarNode('start_date')->end()
                            ->scalarNode('end_date')->end()
                            ->scalarNode('description')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('skills')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('title')->end()
                            ->scalarNode('description')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('interests')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('title')->end()
                            ->scalarNode('description')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
