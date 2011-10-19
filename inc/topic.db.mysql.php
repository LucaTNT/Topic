<?php
class db {
	private $mysql, $config;

	// Setup the DB stuff
	function db($config, $topic){
		// Store config into our DB class
		$this->config = $config;
		unset($config);

		// Check if needed config values are present
		if(!isset($this->config['mysql_host']) || !isset($this->config['mysql_username']) || !isset($this->config['mysql_password']) || !isset($this->config['mysql_database']) || empty($this->config['mysql_host']) || empty($this->config['mysql_username'])  || empty($this->config['mysql_database'])){
			$topic->fatalError(3, 'Missing or empty MySQL\'s config parameters');
		}

		// Try to connect to the db
		$this->connect();

		// Select our database
		$this->selectDb();
	}

	// Connect to MySQL
	function connect(){
		$this->db = mysql_connect($this->config['mysql_host'], $this->config['mysql_username'], $this->config['mysql_password']) or $topic->fatalError(4, 'Unable to connect to MySQL database');
	}

	// Select active DB
	function selectDb(){
		mysql_select_db($this->config['mysql_database'], $db) or $this->config['mysql_username'], $this->config['mysql_password']) or $topic->fatalError(5, 'Unable to open the database ('.$this->config['mysql_database'].')');
	}
}

?>