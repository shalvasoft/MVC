<?php

/**
 * FILE: model_interface.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

    namespace interfaces;

    interface model_interface{
        /**
         * connecting to database
         *
         * @return mixed
         */
        public function db();
    }