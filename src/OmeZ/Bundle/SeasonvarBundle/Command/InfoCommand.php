<?php
namespace OmeZ\Bundle\SeasonvarBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class InfoCommand extends ContainerAwareCommand {
	
	protected function configure() {
		$this->setName('seasonvar:info');
		$this->setDescription('Returns information about show');
		$this->addArgument('id', InputArgument::REQUIRED, 'Show ID');
	}
	
	protected function execute(InputInterface $input, OutputInterface $output) {
		
		$webClient = $this->getContainer()->get('seasonvar.webclient');
		
		$id = $input->getArgument('id');
		$info = $webClient->getShowInfo($id);

		if (!$info) {
			throw new \InvalidArgumentException(sprintf('Show with id "%s" is not found', $id));
		}
		
				
		
		
	}
	
	
}
