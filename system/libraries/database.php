<?php

/**
 * FILE: database.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

	class database implements interfaces\database_interface{
		private $host   = null;
		private $user   = null;
		private $pass   = null;
		private $dbname = null;
		private $path	= null;

		private $dbh;
		private $executed = false;
		private $stmt;

		/**
		 * constructor
		 **/
		public function __construct(){
			$this->host = db_host();
			$this->dbname = db_name();
			$this->user = db_user();
			$this->pass = db_psw();
			$this->path = db_path();

			switch(db_type()){
				case "mysql":
					$dsn = 'mysql:host=' . $this->host . ";port=" . db_port() . ';dbname=' . $this->dbname;
					break;
				case "sqlite":
					$dsn = 'sqlite:' . $this->path . ';';
					break;
				case "postgresql":
					$dsn = 'pgsql:host=' . $this->host . ";port=" . db_port() . ';dbname=' . $this->dbname;
					break;
				default:
					$dsn = 'mysql:host=' . $this->host . ";port=" . db_port() . ';dbname=' . $this->dbname;
			}

			$connection = new PDOConnection($dsn, $this->user, $this->pass, [
				PDO::MYSQL_ATTR_INIT_COMMAND	=> 'SET NAMES utf8',
				PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_CURSOR				=> PDO::CURSOR_FWDONLY,
				PDO::ATTR_TIMEOUT               => 60*60*60*60,
				PDO::ATTR_EMULATE_PREPARES		=> false,
				PDO::ATTR_PERSISTENT			=> false
			]);

			$connection->connect();

			$this->dbh = new Database($connection);
		}

		/**
		 * Provides access to the application PDO instance.
		 *
		 * @return \PDO
		 */
		public function pdo() {
			return $this->dbh;
		}

		/**
		 * set query statement
		 *
		 * @param $query
		 *
		 * @return $this
		 */
		public function query($query){
			/** @noinspection PhpUndefinedMethodInspection */
			$this->stmt = $this->dbh->prepare($query);
			return $this;
		}

		/**
		 * binding database
		 *
		 * @param      $param
		 * @param      $value
		 * @param null $type
		 *
		 * @return $this
		 */
		public function bind($param, $value, $type = null){
			if (is_null($type)) {
				switch (true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}
			/** @noinspection PhpUndefinedMethodInspection */
			$this->stmt->bindValue($param, $value, $type);
			return $this;
		}

		/**
		 * executing query statement
		 *
		 * @return $this
		 */
		public function execute(){
			/** @noinspection PhpUndefinedMethodInspection */
			$this->stmt->execute();
			$this->executed = true;
			return $this;
		}

		/**
		 * fetching all result
		 *
		 * @param int $fetch
		 *
		 * @param null $class
		 * @param array $args
		 * @return mixed
		 */
		public function FetchAll($fetch = PDO::FETCH_ASSOC, $class = null, array $args = []){
			$this->execute();
			if(!is_null($class) && in_array($fetch, [PDO::FETCH_CLASS, PDO::FETCH_OBJ])) {
				/** @noinspection PhpUndefinedMethodInspection */
				return $this->stmt->fetchAll(PDO::FETCH_CLASS, $class, $args);
			}
			/** @noinspection PhpUndefinedMethodInspection */
			return $this->stmt->fetchAll($fetch);
		}

		/**
		 * fetching first result only
		 *
		 * @param int $fetch
		 *
		 * @param null $class
		 * @param array $args
		 * @return mixed
		 */
		public function FetchOne($fetch = PDO::FETCH_ASSOC, $class = null, array $args = []){
			$this->execute();
			if(!is_null($class) && in_array($fetch, [PDO::FETCH_CLASS, PDO::FETCH_OBJ])) {
				/** @noinspection PhpUndefinedMethodInspection */
				return $this->stmt->fetchObject($class, $args);
			}
			/** @noinspection PhpUndefinedMethodInspection */
			return $this->stmt->fetch($fetch);
		}

		/**
		 * fetching column
		 *
		 * @param int $columnNumber
		 *
		 * @return mixed
		 */
		public function FetchColumn($columnNumber=0){
			$this->execute();
			/** @noinspection PhpUndefinedMethodInspection */
			return $this->stmt->fetchColumn($columnNumber);
		}

		/**
		 * counting rows
		 *
		 * @return mixed
		 */
		public function rowCount(){
			/** @noinspection PhpUndefinedMethodInspection */
			return $this->stmt->rowCount();
		}

		/**
		 * counting columns
		 * @return mixed
		 */
		public function columnCount(){
			/** @noinspection PhpUndefinedMethodInspection */
			return $this->stmt->columnCount();
		}

		/**
		 * getting last inserted ID
		 * @return string
		 */
		public function lastInsertId(){
			return $this->dbh->lastInsertId();
		}

		/**
		 * starting transaction
		 *
		 * @return bool
		 */
		public function beginTransaction(){
			return $this->dbh->beginTransaction();
		}

		/**
		 * ending transaction
		 * @return bool
		 */
		public function endTransaction(){
			/** @noinspection PhpUndefinedMethodInspection */
			return $this->dbh->commit();
		}

		/**
		 * transaction savepoint
		 *
		 * @param $savepoint_name
		 *
		 * @return $this
		 */
		public function TransactionSavepoint($savepoint_name){
			$this->query("SAVEPOINT :savepointname");
			$this->bind(':savepointname',$savepoint_name);
			$this->execute();
			return $this;
		}

		/**
		 * canceling transaction
		 *
		 * @return bool
		 */
		public function cancelTransaction(){
			/** @noinspection PhpUndefinedMethodInspection */
			return $this->dbh->rollBack();
		}

		/**
		 * debuging dump parameters
		 *
		 * @return mixed
		 */
		public function debugDumpParams(){
			/** @noinspection PhpUndefinedMethodInspection */
			return $this->stmt->debugDumpParams();
		}

		/**
		 * Reset the execution flag.
		 */
		public function closeCursor() {
			/** @noinspection PhpUndefinedMethodInspection */
			$this->stmt->closeCursor();
			$this->executed = false;
		}
	}