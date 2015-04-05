<?php

namespace jean553\WechatBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Returns the configuration tree of the bundle
     */
    public function getConfigTreeBuilder()
    {
        // create the configuration tree
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('wechat');
        
        // define the children of the bunlde
        $rootNode
            ->children()
                ->scalarNode('appid')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('appsecret')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('token')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
            ->end();
        
        return $treeBuilder;
    }
}
