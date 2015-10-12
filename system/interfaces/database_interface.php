<?php

/**
 * FILE: database_interface.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

    namespace interfaces;

    interface database_interface{

        /**
         * constructor
         */
        public function __construct();

        /**
         * Provides access to the application PDO instance.
         *
         * @return \PDO
         */
        public function pdo();

        /**
         * set query statement
         *
         * @param $query
         *
         * @return $this
         */
        public function query($query);

        /**
         * binding database
         *
         * @param      $param
         * @param      $value
         * @param null $type
         *
         * @return $this
         */
        public function bind($param, $value, $type);

        /**
         * executing query statement
         *
         * @return $this
         */
        public function execute();

        /**
         * fetching all result
         *
         * @param int $fetch
         *
         * @return mixed
         */
        public function FetchAll($fetch);

        /**
         * fetching first result only
         *
         * @param int $fetch
         *
         * @return mixed
         */
        public function FetchOne($fetch);

        /**
         * fetching column
         *
         * @param int $columnNumber
         *
         * @return mixed
         */
        public function FetchColumn($columnNumber);

        /**
         * counting rows
         *
         * @return mixed
         */
        public function rowCount();

        /**
         * counting columns
         * @return mixed
         */
        public function columnCount();

        /**
         * getting last inserted ID
         * @return string
         */
        public function lastInsertId();

        /**
         * starting transaction
         *
         * @return bool
         */
        public function beginTransaction();

        /**
         * ending transaction
         * @return bool
         */
        public function endTransaction();

        /**
         * transaction savepoint
         *
         * @param $savepoint_name
         *
         * @return $this
         */
        public function TransactionSavepoint($savepoint_name);

        /**
         * canceling transaction
         *
         * @return bool
         */
        public function cancelTransaction();

        /**
         * debuging dump parameters
         *
         * @return mixed
         */
        public function debugDumpParams();

        /**
         * Reset the execution flag.
         */
        public function closeCursor();
    }