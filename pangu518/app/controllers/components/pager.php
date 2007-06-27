<?php 
class PagerComponent extends Object
{
	/**
     * The (calling) controller object.
     *
     * @access public
     * @var object
     */
	var $Controller;

	/**
      * The pager object.
      *
      * @access public
      * @var object
      */
	var $Pager;

	/**
      * Configuration parameters
      *
      * @access public
      * @var array
      */
	var $params;

	/**
     * Component pseudo controller
     *
     * @access public
     * @param object $controller Calling controller object
     * @return void
     */
	function startup(&$controller) {
		$this->Controller =& $controller;
	}

	/**
     * Initializes the pager. Must be called before using the component.
     *
     * Takes user configuration and creates pager object ($this->Pager)
     *
     * @access public
     * @param array $config Configuration options for Pager::factory() method
     * @see http://pear.php.net/manual/en/package.html.pager.factory.php
     * @return void
     */
	function init($config)
	{
		// Get the correct URL, even with admin routes
		$here = array();
		if (defined('CAKE_ADMIN') && !empty($this->Controller->params[CAKE_ADMIN])) {
			$here[0] = $this->Controller->params[CAKE_ADMIN];
			$here[2] = substr($this->Controller->params['action'], strlen($this->Controller->params[CAKE_ADMIN]) + 1);
		} else {
			$here[2] = $this->Controller->params['action'];
		}
		$here[1] = Inflector::underscore($this->Controller->params['controller']);
		ksort($here);
		$url = implode('/', $here);

		// Set up the default configuration vars
		$this->params = array(
		'mode' => 'Sliding',
		'perPage' => 10,
		'delta' => 5,
		'totalItems' => '',
		'httpMethod' => 'GET',
		'currentPage' => 1,
		'linkClass' => 'pager',
		'altFirst' => 'First page',
		'altPrev '=> 'Previous page',
		'altNext' => 'Next page',
		'altLast' => 'Last page',
		'separator' => '',
		'spacesBeforeSeparator' => 1,
		'spacesAfterSeparator' => 1,
		'useSessions' => false,
		'firstPagePre'	 => '',
		'firstPagePost' => '',
		'firstPageText' => '<img src="'.$this->Controller->base.'/img/first.gif" alt="">',
		'lastPagePre' => '',
		'lastPagePost' => '',
		'lastPageText' => '<img src="'.$this->Controller->base.'/img/last.gif" alt="">',
		'prevImg' => '<img src="'.$this->Controller->base.'/img/prev.gif" alt="">',
		'nextImg' => '<img src="'.$this->Controller->base.'/img/next.gif" alt="">',
		'altPage' => 'Page',
		'clearIfVoid' => true,
		'append' => false,
		'path' => '',
		'fileName' => $this->Controller->base . DS . $url . DS . '%d',
		'urlVar' => '',
		);

		vendor('Pear/Pager/Pager');

		// Merge with user config
		$this->params = array_merge($this->params, $config);

		// sanitize requested page number
		if (!in_array($this->params['currentPage'], range(1, ceil($this->params['totalItems'] / $this->params['perPage'])))) {
			$this->params['currentPage'] = 1;
		}
		$this->Pager =& Pager::factory($this->params);

		// Set the template vars
		$this->Controller->set('pageLinks',   $this->Pager->getLinks());
		$this->Controller->set('currentPage', $this->params['currentPage']);
		$this->Controller->set('isFirstPage', $this->Pager->isFirstPage());
		$this->Controller->set('isLastPage',  $this->Pager->isLastPage());
	}
}
?>