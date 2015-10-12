<?php

/**
 * FILE: PDOConnection.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */
    class PDOConnection implements interfaces\PDOConnect_interface{
        private $instance;

        private $dsn;
        private $username;
        private $password;
        private $options = [];

        /**
         * constructor
         *
         * @param $dsn
         * @param $username
         * @param $password
         * @param array $options
         */
        public function __construct($dsn, $username, $password, array $options = []) {
            $this->dsn      = $dsn;
            $this->username = $username;
            $this->password = $password;
            $this->options  = $options;
        }

        /**
         * Setting attributes on instance
         *
         * @param $name
         * @param $value
         * @return mixed|void
         */
        public function setAttribute($name, $value) {
            if(!$this->instance instanceof PDO) {
                throw new LogicException('Cannot set PDO attribute. Please make sure you are connected using the connect() method.');
            }
            if($this->instance->setAttribute($name, $value) === false) {
                throw new LogicException('Could not set PDO attribute: ' . $name);
            }
        }

        /**
         * Setting options
         *
         * @param $name
         * @param $value
         */
        public function setOption($name, $value) {
            $this->options[$name] = $value;
        }

        /**
         * getting connection
         * @return PDO
         */
        public function getConnection() {
            if(!$this->instance instanceof PDO) {
                throw new LogicException('No database connection established.');
            }
            return $this->instance;

        }

        /**
         * connecting to database
         *
         * @throws ErrorException
         */
        public function connect() {
            try {
                $this->instance = new PDO($this->dsn, $this->username, $this->password, $this->options);
            }catch(PDOException $exception) {
                throw new ErrorException('Could not connect to the database!', null, $exception);
            }
        }

        /**
         * disconnecting from database
         */
        public function disconnect() {
            $this->instance = null;
        }
    }