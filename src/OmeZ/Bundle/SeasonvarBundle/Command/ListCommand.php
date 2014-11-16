<?php
namespace OmeZ\Bundle\SeasonvarBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends ContainerAwareCommand {
	
	
	protected function configure() {
		$this->setName('seasonvar:list');
		$this->setDescription('Returns list of avalable series');
	}
	
	protected function execute(InputInterface $input, OutputInterface $output) {
		
		$webClient = $this->getContainer()->get('seasonvar.webclient');
		
		foreach ($webClient->getShowList() as $info) {
			$output->writeln(sprintf('<comment>%2$d</comment> <info>%1$s</info>', $info['title'], $info['id']));
		}
				
	}
	
	
}
