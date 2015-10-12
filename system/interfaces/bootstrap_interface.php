<?php

/**
 * FILE: bootstrap_interface.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

    namespace interfaces;

    interface bootstrap_interface{
        public function Init();
        public function Get_Url();
        public function Set_Controller();
        public function Set_Method();
        public function _Error($code);
    }