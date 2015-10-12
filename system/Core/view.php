<?php

/**
 * FILE: view.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

    class view implements interfaces\view_interface{
        public $Err = false;

        public function render ($PageName){
            require_once views_dir()."$PageName.php";
        }
    }