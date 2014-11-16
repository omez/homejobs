<?php
namespace OmeZ\Bundle\SeasonvarBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use OmeZ\Bundle\SeasonvarBundle\Entity\Show;

class ShowRepository extends EntityRepository {

	/**
	 * Finds show by season Id
	 * 
	 * @param integer $id
	 * @return Show
	 */
	public function findBySeasonId($id) {
		
		$dql = sprintf('SELECT show FROM %s show INNER JOIN %s season WHERE season.originalId = :id', $this->_entityName, '');
		
		$query = $this->_em->createQuery($dql);
		$query->setParameter('id', $id);
		
		return $query->getFirstResult();
	}
	
	
	public function getNames() {
		
		$dql = sprintf('SELECT id,title FROM %s show', $this->_entityName);
		$query = $this->_em->createQuery($dql);
		
		$results = $query->getArrayResult();
		
		
	}
	
}
