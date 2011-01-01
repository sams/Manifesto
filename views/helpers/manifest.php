<?php
/*
 * class Manifest
 */

class ManifestHelper extends AppHelper {
	public $helpers = array('Html');


/**
 * Disable autoInclusion of view js files.
 *
 * @var string
 */
	public $autoInclude = true;

/**
 * parsed ini file values.
 *
 * @var array
 */
	protected $_currentView;

/**
 * parsed ini file values.
 *
 * @var array
 */
	protected $_iniFile;

/**
 * Contains the build timestamp from the file.
 *
 * @var string
 */
	protected $_buildTimestamp;
    
/**
 * Constructor - finds and parses the ini file the plugin uses.
 *
 * @return void
 */
	public function __construct($options = array()) {
		if (!empty($options['iniFile'])) {
			$iniFile = $options['iniFile'];
		} else {
			$iniFile = CONFIGS . 'manifesto.ini';
		}
		if (!file_exists($iniFile)) {
			$iniFile = App::pluginPath('Manifesto') . 'config' . DS . 'config.ini';
		}
		$this->_iniFile = parse_ini_file($iniFile, true);
                
                $this->_currentView = &ClassRegistry::getObject('view');
	
        //die(debug($this->_iniFile));
        //die(debug($this));
        }
        
    

/**
 * Modify the runtime configuration of the helper.
 * Used as a get/set for the ini file values.
 * 
 * @param string $name The dot separated config value to change ie. Css.searchPaths
 * @param mixed $value The value to set the config to.
 * @return mixed Either the value being read or null.  Null also is returned when reading things that don't exist.
 */
	public function config($name, $value = null) {
		if (strpos($name, '.') === false) {
			return null;
		}
		list($section, $key) = explode('.', $name);
		if ($value === null) {
			return isset($this->_iniFile[$section][$key]) ? $this->_iniFile[$section][$key] : null;
		}
		$this->_iniFile[$section][$key] = $value;
	}

/**
 * Set options, merge with existing options.
 *
 * @return void
 */
	public function options($options) {
		$this->options = Set::merge($this->options, $options);
	}

/**
 * AfterRender callback.
 *
 * Adds automatic view js files if enabled.
 * Adds css/js files that have been added to the concatenation lists.
 *
 * Auto file inclusion adopted from Graham Weldon's helper
 * http://bakery.cakephp.org/articles/view/automatic-javascript-includer-helper
 *
 * @return void
 */
	public function afterRender() {
	}    
    
    /*
     * function get_manifesturi
     * @param 
     */
    
    function _get_uri() {
        $manifest = 'mymanifest';
        foreach($this->params as $key => $var) {
            
        //    switch($key) {
        //        case 'controller':
        //$manifest.= '_' . $var;
        //        break;
        //        case 'action':
        //if($this->params['slug']) {
        //$manifest = $this->params['controller'] . $this->params['slug'];
        //} else {
        //$manifest.= $var;   
        //}
        //        break;
        //        
        //        
        //    }
            
        }
        $manifest = $this->Html->url($this->_iniFile['Manifest']['baseUrl'] . $manifest . '.' . $this->_iniFile['Manifest']['suffix']);
        return $manifest;
    }
    
    /*
     * function beforeRender
     * @param 
     */
    
    function beforeRender() {
        $this->_currentView->viewVars['manifest_for_layout'] = $this->_get_uri();
    }
}