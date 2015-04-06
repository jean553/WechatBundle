<?php

namespace jean553\WechatBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class WechatExtension extends Extension
{
    /**
     * Load the Wechat bundle configuration
     *
     * @param array $configs additional configurations
     * @param ContainerBuilder $container container of the extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        // load the bundle configuration skeleton
        // with additional specified configurations
        $this->processConfiguration(
            $configuration,
            $configs
        );
    }
}
