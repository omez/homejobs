<?php
namespace OmeZ\Bundle\SeasonvarBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use OmeZ\Bundle\SeasonvarBundle\Grabber\IndexGrabber;

class SyncCommand extends ContainerAwareCommand {
	
	const SECTION_ALL = 'all';
	const SECTION_EPISODES = 'episodes';
	const SECTION_SEASONS = 'seasons';
	const SECTION_SHOWS = 'shows';
	
	/**
	 * {@inheritDoc}
	 */
	protected function configure() {
		$this->setName('seasonvar:sync');
		$this->setDescription('Syncronizes local database with seasonvar site');
		//$this->addArgument('section', InputArgument::OPTIONAL, 'Section to sync', 'all');
	}

	/**
	 * {@inheritDoc}
	 */
	protected function execute(InputInterface $input, OutputInterface $output) {
		
		$client = new \GuzzleHttp\Client();
		
		$index = new IndexGrabber($client);
		$shows = $index->getShows();
		
		
		$em = $this->getContainer()->get('doctrine.orm.entity_manager');
		
		$arr = $em->createQuery('SELECT show FROM OmeZ\Bundle\SeasonvarBundle\Entity\Show')->getArrayResult();
		
		var_dump($arr);
		
		foreach ($shows as $meta) {
			// sync				
		}		
		
	}
	
	
	
	
}
