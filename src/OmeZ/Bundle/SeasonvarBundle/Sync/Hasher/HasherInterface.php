<?php
namespace OmeZ\Bundle\SeasonvarBundle\Sync\Hasher;

interface HasherInterface {
	
	public function supports($data);	
	
	public function getHash();
	
}
