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
		
		$controller = $this->in('Please enter controller: ', null, 'Pages');
		$action = $this->in('Please enter action: ', null, 'display');
		$handle = $this->in('Please enter id or slug: ', null, 'home');
		
		$this->out(compact($controller, $action, $handle));
        
		$this->_Socket = new HttpSocket();

		$request = $this->in('Please enter content referance: ', null, Router::url(array(
			'plugin' => null, 'controller' => $controller,
			'action' => $action,
			$handle
		), true ));
		$this->log('request', 'manifesto');
		$this->log($request);
		$this->out();
    }
    
    /*
     * function _create
     * @param $arg
     */
    
    function _create($arg) {
	if (empty($this->args) || count($this->args) > 1) {
		return $this->help();
	}

	$url = $this->args[0];
	$defaults = array('t' => 100, 'n' => 10);
	$options  = array_merge($defaults, $this->params);
	$times = array();

	$this->out(String::insert(__d('debug_kit', '-> Testing :url', true), compact('url')));
	$this->out("");
	for ($i = 0; $i < $options['n']; $i++) {
		if (floor($options['t'] - array_sum($times)) <= 0 || $options['n'] <= 1) {
			break;
		}

		$contents = file_get_contents($url);

	}
	$this->_make(sha1($url.Configure::read('Security.salt'), $contents));
    }
	
/**
 * Prints calculated results
 *
 * @param array $times Array of time values
 * @return void
 * @access protected
 */
    function _make($name, $contents) {
	App::import('Core', 'File');
	App::import('Core', 'Folder');
    }
}
?>