<?php

/**
 * @package     FAQ
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FAQModelsDefault extends JModelBase
{
	//protected variables
	protected $__state_set = null;
	protected $_total = null;
	protected $_pagination = null;
	protected $_db = null;
	protected $id = null;

	function __construct()
	{
		parent::__construct();
		$this->_db = JFactory::getDBO();

		$app = JFactory::getApplication();
		$ids = $app->input->get("cids",null,'array');

		$id = $app->input->get("id");
		if ( $id && $id > 0 ){
			$this->id = $id;
		}else if ( count($ids) == 1 ){
			$this->id = $ids[0];
		}else{
			$this->id = $ids;
		}
	}

	/**
	 * Modifies a property of the object, creating it if it does not already exist.
	 *
	 * @param string $property The name of the property.
	 * @param mixed $value The value of the property to set.
	 *
	 * @return mixed Previous value of the property.
	 *
	 * @since 11.1
	 */
	public function set($property, $value = null)
	{
		$previous = isset($this->$property) ? $this->$property : null;
		$this->$property = $value;

		return $previous;
	}

	public function get($property, $default = null)
	{
		return isset($this->$property) ? $this->$property : $default;
	}

	/**
	 * Gets an array of objects from the results of database query.
	 *
	 * @param string $query The query.
	 * @param integer $limitstart Offset.
	 * @param integer $limit The number of records.
	 *
	 * @return array An array of results.
	 *
	 * @since 11.1
	 */
	protected function _getList($query, $limitstart = 0, $limit = 0)
	{
		$db = JFactory::getDBO();
		$db->setQuery($query, $limitstart, $limit);
		$result = $db->loadObjectList();

		return $result;
	}

	/**
	 * Gets row object from the results of database query.
	 *
	 * @param string $query The query.
	 *
	 * @return array An array of results.
	 *
	 * @since 11.1
	 */
	protected function _getRow($query)
	{
		$db = JFactory::getDBO();
		$db->setQuery($query);
		$result = $db->loadObject();

		return $result;
	}

	/**
	 * Build query and where for protected _getList function and return a list
	 *
	 * @return array An array of results.
	 */
	public function listItems()
	{
		$query = $this->_buildQuery();
		$query = $this->_buildWhere($query);
		$list = $this->_getList($query, $this->limitstart, $this->limit);

		return $list;
	}

	/**
	 * Build query and where for protected _getList function and return a list
	 *
	 * @return array An array of results.
	 */
	public function getItem()
	{
		$query = $this->_buildQuery();
		$query = $this->_buildWhere($query);
		$list = $this->_getRow($query);

		return $list;
	}

	/**
	 * Returns a record count for the query
	 *
	 * @param string $query The query.
	 *
	 * @return integer Number of rows for query
	 *
	 * @since 11.1
	 */
	protected function _getListCount($query)
	{
		$db = JFactory::getDBO();
		$db->setQuery($query);
		$db->query();

		return $db->getNumRows();
	}

	/* Method to get model state variables
	*
	* @param string $property Optional parameter name
	* @param mixed $default Optional default value
	*
	* @return object The property where specified, the state object where omitted
	*
	* @since 11.1
	*/
	public function getState($property = null, $default = null)
	{
		if (!$this->__state_set)
		{
			// Protected method to auto-populate the model state.
			$this->populateState();

			// Set the model state set flag to true.
			$this->__state_set = true;
		}

		return $property === null ? $this->state : $this->state->get($property, $default);
	}
	/**
	 * Get total number of rows for pagination
	 */
	function getTotal()
	{
		if ( empty ( $this->_total ) )
		{
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}



	/**
	 * Save data in db
	 */
	public function store($data=null)
	{
		$data = $data ? $data : JRequest::get('post');
		$row = JTable::getInstance($data['table'],'Table');

		$date = date("Y-m-d H:i:s");

		// Bind the form fields to the table
		if (!$row->bind($data))
		{
			return false;
		}

		$row->modified = $date;
		if ( !$row->created )
		{
			$row->created = $date;
		}

		// Make sure the record is valid
		if (!$row->check())
		{
			return false;
		}
		// Save the web link table to the database
		if (!$row->store())
		{
			return false;
		}

		return $row;
	}

	/**
	 * Get order position
	 * @return int
	 */
	public function getNextOrder($where = '', $table, $column = 'ordering')
	{
		$query = "SELECT MAX({$column}) FROM #__".$table;
		$query .= ($where ? " WHERE ".$where." " : "");
		$this->_db->setQuery($query);
		$maxord = $this->_db->loadResult();
		if ($this->_db->getErrorNum())
		{
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return $maxord + 1;
	}

	public function generateAlias ($name) {
		return str_replace(' ', '_', preg_replace('/[^ a-zа-яё\d]/ui', '',strtolower($name)));
	}
}