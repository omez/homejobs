<?php
namespace OmeZ\Bundle\SeasonvarBundle\Entity;

/**
 * Episode orm representation
 * 
 * @author Alexander Sergeychik
 */
class Episode {

	/**
	 * ID of episode
	 * 
	 * @var integer
	 */
	private $id;
	
	/**
	 * Season which epesode depends to
	 * 
	 * @var Season
	 */
	protected $season;
	
	/**
	 * Episode number
	 * 
	 * @var integer
	 */	
	protected $number;

	/**
	 * Episode href
	 * 
	 * @var string
	 */
	protected $href;	
	
}