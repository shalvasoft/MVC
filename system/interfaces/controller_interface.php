<?php

/**
 * FILE: controller_interface.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

    namespace interfaces;

    interface controller_interface{
        /**
         * Loading model
         *
         * @param $NodelName
         *
         * @return mixed
         */
        public function Get_Model($NodelName);
    }