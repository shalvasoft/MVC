<?php

/**
 * FILE: bootstrap.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

    class bootstrap	implements interfaces\bootstrap_interface{
        private $_Url;
        private $_Controller;
        public function Init (){
            /**
             * show all errors
             */
            show_errors();

            /**
             * check if page is secured
             */
            if(protocol() == 'https') forceHTTPS();

            /**
             * initializing session
             */
            sessions::init();

            /**
             * getting requested url
             */
            $this->Get_Url();

            /**
             * replace - to _
             */
            array_walk($this->_Url , array($this, 'Url_replace'));

            /**
             * check if controller name not exists
             */
            if (empty($this->_Url[0])) {
                $this->_Url[0] = default_controller();
            }

            $this->Set_Controller();
            $this->Set_Method();
        }

        /**
         * getting requested url
         */
        public function Get_Url (){
            $url = isset($_GET['url']) ? $_GET['url'] : null;
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $this->_Url = explode('/', $url);
        }

        /**
         * replace - to _
         *
         * @param $item
         */
        private function Url_replace( &$item) {
            $item = str_replace('-', '_', $item);
        }

        /**
         * set controller class
         */
        public function Set_Controller (){
            $file = controllers_dir() . $this->_Url[0] . '.php';
            if(!file_exists($file)){
                $this->_error(404);
                exit;
            }
            /** @noinspection PhpIncludeInspection */
            require_once $file;
            $this->_Controller = new $this->_Url[0];
            /** @noinspection PhpUndefinedMethodInspection */
            $this->_Controller->Get_Model($this->_Url[0]);
//			$this->_Controller->model
        }

        /**
         * setting controller method
         */
        public function Set_Method (){
            $length = count($this->_Url);
            if ($length > 1) {
                if (!method_exists($this->_Controller, $this->_Url[1])) {
                    $this->_error(404);
                    exit;
                }
            }
            switch ($length) {
                case 5:
                    //Controller->Method(Param1, Param2, Param3)
                    $this->_Controller->{$this->_Url[1]}($this->_Url[2], $this->_Url[3], $this->_Url[4]);
                    break;

                case 4:
                    //Controller->Method(Param1, Param2)
                    $this->_Controller->{$this->_Url[1]}($this->_Url[2], $this->_Url[3]);
                    break;

                case 3:
                    //Controller->Method(Param1, Param2)
                    $this->_Controller->{$this->_Url[1]}($this->_Url[2]);
                    break;

                case 2:
                    //Controller->Method(Param1, Param2)
                    $this->_Controller->{$this->_Url[1]}();
                    break;

                default:
                    /** @noinspection PhpUndefinedMethodInspection */
                    $this->_Controller->index();
                    break;
            }
        }

        /**
         * getting error
         *
         * @param $code
         */
        public function _Error ($code){
            $file = controllers_dir() . default_error() . '.php';
            /** @noinspection PhpIncludeInspection */
            require_once $file;
            $this->_Controller = new error();
            switch ($code){
                case 404:
                    $this->_Controller->error404();
                    break;
                case 403:
                    $this->_Controller->error403();
                    break;
                case 503:
                    $this->_Controller->error503();
                    break;
                default;
            }
            exit;
        }
    }