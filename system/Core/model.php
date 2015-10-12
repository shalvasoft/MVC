<?php

/**
 * FILE: model.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

    class model	implements interfaces\model_interface{

        /**
         * connecting to database
         *
         * @return database
         */
        public function db (){
            return new database();
        }
    }