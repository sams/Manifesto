<?php
    /**
     * class ManifestsShell
     */
    
    class ManifestsShell extends shell {
        
	public $tasks = array('Manage');
        
        /**
         * main
         * @param 
         */
        
        public function main() {
		$this->out('[S]how');
		$this->out('[C]reate');
		$this->out('[R]emove');
		$this->out('[Q]uit');

		$action = strtoupper($this->in(__('What would you like to do?', true), array('s','c','r','q'),'q'));
		switch($action) {
			case 'S':
				$this->show();
			break;
			case 'C':
				$this->create();
			break;
			case 'R':
				$this->remove();
			break;
			case 'Q':
				$this->_stop(0);
			break;
		}
		$this->main();
        }
        
        /**
         * show
         * @param 
         */
        
        public function show() {
		$this->out('Manifests Shell: show manifests');
		$this->Manage->execute('show all');
		$this->hr();
        }
        
        /**
         * create
         * @param 
         */
        
        public function create() {
		$this->out('Manifests Shell: create a manifest');
		$this->Manage->execute('create');
		$this->hr();
        }
        
        /**
         * cull
         * @param 
         */
        
        public function remove() {
		$this->out('Manifests Shell: remove a manifest');
		$this->Manage->execute('remove');
		$this->hr();
        }

        /**
         * help
         *
         * @return void
         */
	public function help() {
		$this->out('Manifests Shell');
		$this->hr();
		$this->out('Usage: cake manifests <command>');
		$this->hr();
		$this->out("show - Lists current manifests.");
		$this->hr();
		$this->out("create - Create a manifest.");
		$this->hr();
		$this->out("remove - Remove a manifest.");
		$this->out();
	}
    }