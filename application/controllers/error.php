<?php

/**
 * FILE: error.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

    class error	extends controller{

        /**
         * constructor
         */
        public function __construct(){
            parent::__construct();
            $this->view->Err = true;
        }

        /**
         * Error 400
         * Bad Request
         */
        public function error400(){
            /** @noinspection PhpUndefinedFieldInspection */
            $this->view->title = '400 Bad Request';
            $this->view->render('header');
            $this->view->render('errors/400');
            $this->view->render('footer');
        }

        /**
         * Error 401
         * Unauthorized
         */
        public function error401(){
            /** @noinspection PhpUndefinedFieldInspection */
            $this->view->title = '401 Unauthorized';
            $this->view->render('header');
            $this->view->render('error/401');
            $this->view->render('footer');
        }

        /**
         * Error 403
         * Forbidden
         */
        public function error403(){
            /** @noinspection PhpUndefinedFieldInspection */
            $this->view->title = '403 Forbidden';
            $this->view->render('header');
            $this->view->render('errors/403');
            $this->view->render('footer');
        }

        /**
         * Error 404
         * Not Found
         */
        public function error404(){
            /** @noinspection PhpUndefinedFieldInspection */
            $this->view->title = '404 Not Found';
            $this->view->render('header');
            $this->view->render('errors/404');
            $this->view->render('footer');
        }

        /**
         * Error 500
         * Internal Server Error
         */
        public function error500(){
            /** @noinspection PhpUndefinedFieldInspection */
            $this->view->title = '500 Internal Server Error';
            $this->view->render('header');
            $this->view->render('errors/500');
            $this->view->render('footer');
        }

        /**
         * Error 503
         * Service Unavailable
         */
        public function error503(){
            /** @noinspection PhpUndefinedFieldInspection */
            $this->view->title = '503 Service Unavailable';
            $this->view->render('header');
            $this->view->render('errors/503');
            $this->view->render('footer');
        }
    }