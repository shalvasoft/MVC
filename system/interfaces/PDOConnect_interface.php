<?php

/**
 * FILE: PDOConnect_interface.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */
    namespace interfaces;

    interface PDOConnect_interface{

        /**
         * constructor
         *
         * @param $dsn
         * @param $username
         * @param $password
         * @param array $options
         */
        public function __construct($dsn, $username, $password, array $options);

        /**
         * Setting attributes on instance
         *
         * @param $name
         * @param $value
         * @return mixed
         */
        public function setAttribute($name, $value);

        /**
         * Setting options
         *
         * @param $name
         * @param $value
         */
        public function setOption($name, $value);

        /**
         * getting connection
         *
         * @return mixed
         */
        public function getConnection();

        /**
         * connecting to database
         *
         * @return mixed
         */
        public function connect();

        /**
         * disconnecting from database
         */
        public function disconnect();

    }