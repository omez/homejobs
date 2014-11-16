<?php
namespace OmeZ\Bundle\SeasonvarBundle\Sync;

use Doctrine\Common\Persistence\ObjectManager;

class SyncManager {

	/**
	 * Object manager
	 * 
	 * @var ObjectManager
	 */
	protected $objectManager;
	
	
	public function __construct(ObjectManager $objectManager) {
		$this->objectManager = $objectManager;
	}
	
	/**
	 * Performs synchronization
	 * 
	 * @param AbstractAdapter $adapter
	 */
	public function synchronize(AbstractAdapter $adapter) {
			
		$job = $adapter->prepare();
		
		// remove entities
		foreach ($job->getRemovals() as $object) {
			$this->objectManager->remove($object);
		}
		
		foreach ($job->getUpdates() as $object) {
			//$this->objectManager->
		}
		
		foreach ($job->getInserts() as $object) {
			$this->objectManager->persist($object);
		}
		
		$this->objectManager->flush();
	}
	
}
