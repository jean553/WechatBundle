<?php

namespace jean553\WechatBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;
use jean553\WechatBundle\DependencyInjection\WechatExtension;

class WechatExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the configuration contains
     * the required parameters
     *
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testParameters()
    {
        // load a configuration
        $loader = new WechatExtension();
        $config = $this->getEmptyConfig();

        $loader->load(array($config), new ContainerBuilder());
    }
 
    /**
     * Returns an empty configuration
     *
     * @return array
     */
    private function getEmptyConfig()
    {
        $parser = new Parser();
        return $parser->parse("");
    }
}
