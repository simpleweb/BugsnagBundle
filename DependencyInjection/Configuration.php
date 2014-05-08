<?php

namespace Simpleweb\BugsnagBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('bugsnag');

        $rootNode
            ->children()
                ->scalarNode('api_key')->end()
                ->scalarNode('app_version')
                    ->defaultNull()
                ->end()
                ->scalarNode('client')
                    ->defaultValue('Bugsnag_Client')
                ->end()
                ->scalarNode('shutdown_listener')
                    ->defaultValue('Simpleweb\BugsnagBundle\EventListener\ShutdownListener')
                ->end()
                ->scalarNode('exception_listener')
                    ->defaultValue('Simpleweb\BugsnagBundle\EventListener\ExceptionListener')
                ->end()
                ->arrayNode('notify_stages')
                    ->defaultValue(array('stage', 'prod'))
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('proxy')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('host')->defaultNull()->end()
                        ->scalarNode('port')->defaultNull()->end()
                        ->scalarNode('user')->defaultNull()->end()
                        ->scalarNode('password')->defaultNull()->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
