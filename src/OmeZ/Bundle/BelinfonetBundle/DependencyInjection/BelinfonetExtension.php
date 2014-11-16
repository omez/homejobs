<?php

namespace OmeZ\Bundle\BelinfonetBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BelinfonetExtension extends Extension {
	
	const WEBSITE_SERVICE_ID = 'omez_belinfonet.website_client';
	
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        $this->addFactory($config, $container);
    }
    
    
    
    protected function addFactory(array $config, ContainerBuilder $container) {
    	
    	if (!$container->has(self::WEBSITE_SERVICE_ID . '.abstract')) {
    		return;
    	}
    	
    	$definition = new DefinitionDecorator(self::WEBSITE_SERVICE_ID . '.abstract');
    	$definition->replaceArgument(1, $config['username']);
    	$definition->replaceArgument(2, $config['password']);
    	
    	$container->setDefinition(self::WEBSITE_SERVICE_ID, $definition);
    }
    
}
