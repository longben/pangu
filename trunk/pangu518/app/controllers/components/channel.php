<?php
class ChannelComponent extends Object {
    
	var $controller;

	var $uses = array('Channel');

    function startup(&$controller){
		$this->controller = &$controller;
    }

    function fetchData(&$controller){
        return $this->controller->Channel->findAll();
    }
}
?>