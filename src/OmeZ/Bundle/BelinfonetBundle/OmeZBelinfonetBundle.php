<?php

namespace OmeZ\Bundle\BelinfonetBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use OmeZ\Bundle\BelinfonetBundle\DependencyInjection\BelinfonetExtension;

class OmeZBelinfonetBundle extends Bundle {
	
	public function build(ContainerBuilder $container) {
		$container->registerExtension(new BelinfonetExtension());
	}
	
}
