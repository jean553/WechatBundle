<?php

namespace jean553\WechatBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class WechatBundle extends Bundle 
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
