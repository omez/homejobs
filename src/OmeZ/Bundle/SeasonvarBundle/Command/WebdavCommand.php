<?php
namespace OmeZ\Bundle\SeasonvarBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sabre\DAV;

class WebdavCommand extends ContainerAwareCommand {

	protected function configure() {
		$this->setName('seasonvar:webdav');
		$this->setDescription('Starts WebDAV server');
	}

	/**
	 * {@inheritDoc}
	 */
	protected function execute(InputInterface $input, OutputInterface $output) {
		// TODO: Auto-generated method stub
	
	}

}
