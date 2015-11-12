<?php

namespace Fbeen\CroppicBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fbeen_croppic');

        $rootNode
            ->children()
                ->arrayNode('upload')
                    ->children()
                        ->scalarNode('filepath')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('original')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('cropped')->isRequired()->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end();
        
        return $treeBuilder;
    }
}
