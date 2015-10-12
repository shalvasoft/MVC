<?php

/**
 * FILE: index.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

    class index extends controller{
        public function __construct(){
            parent::__construct();
        }
        public function index(){
            /** @noinspection PhpUndefinedFieldInspection */
            $this->view->title = 'Home';
            $this->view->render('header');
            $this->view->render('index');
            $this->view->render('footer');
        }
    }