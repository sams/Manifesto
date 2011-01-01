<?php
App::import('Core', array('HttpSocket', 'Router'));
/*
 * class SubmitSitemapTask extends Shell {
 */

class ManageTask extends Shell {
    
    /*
     * execute
     * @param $arg
     */
    
    function execute() {
        
                $args = func_get_args();
                
                print_r($args);
        
                $controller = $action = false;
        
		$this->_Socket = new HttpSocket();

		$request = $this->in('Please enter content referance: ', null, Router::url(array(
			'plugin' => null, 'controller' => $controller,
			'action' => $action
		), true ));
    }
}
?>