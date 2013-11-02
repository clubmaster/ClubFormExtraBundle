<?php

namespace Club\FormExtraBundle\DependencyInjection;

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
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('club_form_extra');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
            ->scalarNode('title')->defaultValue('ClubMaster')->end()
            ->scalarNode('tinymce_width')->defaultValue('80%')->end()
            ->scalarNode('tinymce_height')->defaultValue('300px')->end()
            ->scalarNode('tinymce_language_url')->defaultNull()->end()
            ->end();

        return $treeBuilder;
    }
}
