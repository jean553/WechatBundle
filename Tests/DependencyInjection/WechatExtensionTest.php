<?php

namespace jean553\WechatBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;
use jean553\WechatBundle\DependencyInjection\WechatExtension;

class WechatExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    protected $configuration;

    /**
     * Test if the configuration contains
     * the required parameters
     *
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testEmptyParameters()
    {
        // load a configuration
        $loader = new WechatExtension();
        $config = $this->getEmptyConfig();

        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * Test if the configuration loads
     * correctly the given parameters
     */
    public function testCorrectParameters()
    {
        $this->configuration = new ContainerBuilder();

        $this->assertParameter('abcdefghij123456789', 'appid');
        $this->assertParameter('123456789abcdefghij','appsecret');
        $this->assertParameter('1a2b3c4d5e6f7g8i9j','token');
    }

    /**
     * Check if the parameter value
     * is the same as the given one
     *
     * @param mixed $value value to compare
     * @param string $key configuration parameter name
     */
    private function assertParameter($value, $key)
    {
        $this->assertEquals(
            $value, 
            $this->configuration->getParameter($key)
        );
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

    /**
     * Returns a full correct configuration
     *
     * @return array
     */
    private function getFullConfig()
    {
        $yaml = <<<EOF
            appid: abcdefghij123456789
            appsecret: 123456789abcdefghij
            token: 1a2b3c4d5e6f7g8i9j  
        EOF;

        $parser = new Parser();
        return $parser->parse($yaml);
    }
}
