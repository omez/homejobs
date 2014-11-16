<?php
namespace OmeZ\Bundle\BelinfonetBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class InfoCommand extends ContainerAwareCommand {

	protected function configure() {
		$this->setName('belinfonet:info');
		$this->setDescription('Dumps info about belinfonet account');
	}
	
	protected function execute(InputInterface $input, OutputInterface $output) {
		$websiteClient = $this->getContainer()->get('omez_belinfonet.website_client');

		$info = $websiteClient->getAccountInfo();
		
		$output->writeln(sprintf("<info>ID</info>: %s", $info['id']));
		$output->writeln(sprintf("<info>Status</info>: %s", $info['enabled'] ? 'enabled' : 'disabled'));
		$output->writeln(sprintf("<info>Balance</info>: %s", number_format($info['balance'], 0, '.', '`')));
		
		$websiteClient->reactivate();
	}
	
}
