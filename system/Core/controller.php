<?php

/**
 * FILE: controller.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */
    class controller implements interfaces\controller_interface{

        /**
         * model class
         * @var null
         */
        public $model = null;

        /**
         * view class
         * @var view|null
         */
        public $view = null;

        /**
         * constructor
         */
        public function __construct(){
            $this->view = new view();
        }

        /**
         * Loading model
         *
         * @param $NodelName
         *
         * @return mixed|void
         */
        public function Get_Model ($NodelName){
            $path = models_dir() . $NodelName.'_model.php';
            if (file_exists($path)) {
                $modelName = $NodelName . '_model';
                require_once models_dir() . "$modelName.php" . "";
                $this->model = new $modelName();
            }
        }

        /**
         * Not have permition to view this page
         */
        public function Not_have_Perm() {
            /** @noinspection PhpIncludeInspection */
            require_once controllers_dir() . default_error();
            $err = new error();
            $err->error403();
            exit;
        }
    }