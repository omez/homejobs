<?php
namespace OmeZ\Bundle\SeasonvarBundle\Sync;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Syncronization resume
 * 
 * @author Alexander Sergeychik
 */
class UnitOfWork {
	
	const COLLECTION_REMOVALS = 'remove';
	const COLLECTION_UPDATES = 'update';
	const COLLECTION_INSERTS = 'insert';

	/**
	 * Collections
	 * 
	 * @var array
	 */
	protected $collections = array();
	
	/**
	 * Constructs unit
	 * 
	 * @return void
	 */
	public function __construct() {
		$this->collections = array(
			self::COLLECTION_REMOVALS => new ArrayCollection(), 
			self::COLLECTION_INSERTS => new ArrayCollection(), 
			self::COLLECTION_UPDATES => new ArrayCollection()
		);
	}

	/**
	 * Returns removals collection
	 * 
	 * @return ArrayCollection
	 */
	public function getRemovals() {
		return $this->collections[self::COLLECTION_REMOVALS];
	}

	/**
	 * Returns updates collection
	 *
	 * @return ArrayCollection
	 */
	public function getUpdates() {
		return $this->collections[self::COLLECTION_UPDATES];
	}
	
	/**
	 * Returns inserts collection
	 *
	 * @return ArrayCollection
	 */
	public function getInserts() {
		return $this->collections[self::COLLECTION_UPDATES];
	}
	
	/**
	 * Destructs unit
	 * 
	 * @return void
	 */
	public function __destruct() {
		$this->collections = null;
	}
	
}
