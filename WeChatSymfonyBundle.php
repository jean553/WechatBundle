<?php

namespace jean553\WeChatSymfonyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class WeChatSymfonyBundle extends Bundle 
{
    /**
     * Build the bundle with a container
     *
     * @param ContainerBuilder $container bundle container
     */
    public function build(ContainerBuilder $container) {
        
        // build the parent Bundle object
        parent::build($container);
    }
}
