<?php

class topic {
	// Let's set some variables
	private $db, $config;

	// Initialise the core
	function topic(){
		// First, set our root directory
		define("ROOT_DIR", str_replace('inc/topic.core.php', '', $_SERVER['SCRIPT_FILENAME']));

		// Then include config file
		if(!is_readable(ROOT_DIR.'/config.php') || !include(ROOT_DIR.'/config.php')){
			$this->fatalError(1, "Unable to open config file");
		}

		// Save configuration
		$this->config = $config;
		unset($config);

		// And setup DB connection
		$this->dbSetup();

	}

	// Fatal error handler
	function fatalError($errorCode, $errorMessage){
		// Right now it only dies printing the error message
		die("Error $errorCode: $errorMessage");
	}

	// Setup DB connection handler
	function dbSetup(){
		// If no alternative DB plugin is set, we just use the default MySQL
		if(!isset($this->config['dbPlugin'])){
			$this->config['dbPlugin'] = 'mysql';	
		}

		// Try to include the required DB plugin, or die
		if(!is_readable(ROOT_DIR.'inc/topic.db.'.$this->config['dbPlugin'].'.php') || !include(ROOT_DIR.'inc/topic.db.'.$this->config['dbPlugin'].'.php')){
			$this->fatalError(2, 'Unable to open the required DB plugin ('.$this->config['dbPlugin'].')');
		}

		// Assign our DB object to the internal db variable
		$this->db = new db($this->config['db'], $this);
	}

}

$topic = new topic;
?>