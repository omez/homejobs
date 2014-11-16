<?php

namespace OmeZ\Bundle\SeasonvarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

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
        $rootNode = $treeBuilder->root('ome_z_seasonvar');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
    
    
    
    protected function addWebDav(ArrayNodeDefinition $node) {
    	
    	$webDavNode = $node->children()->arrayNode('webDav');
    	
    	$children = $webDavNode->children();
    	
    	$children->scalarNode('path')->isRequired()->cannotBeEmpty();
    	
    	
    }
    
}
