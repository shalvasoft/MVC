<?php

/**
 * FILE: autoloadManager_interface.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

    interface autoloadManager_interface{

        /**
         * Constructor
         *
         * @param string $saveFile    Path where autoload files will be saved
         * @param int    $scanOptions Scan options
         */
        public function __construct($saveFile, $scanOptions);

        /**
         * Get the path where autoload files are saved
         *
         * @return string path where autoload files will be saved
         */
        public function getSaveFile();

        /**
         * Set the path where autoload files are saved
         *
         * @param $pathToFile
         * @internal param string $path path where autoload files will be saved
         */
        public function setSaveFile($pathToFile);

        /**
         * Set the file regex
         *
         * @param string
         */
        public function setFileRegex($regex);

        /**
         * Set the file extensions
         *
         * Another method to set up the $_filesRegex
         *
         * @param string|array allowed extension string or array with extension strings
         * @return void
         */
        public function setAllowedFileExtensions($extensions);

        /**
         * Add a new folder to parse
         *
         * @param string $path Root path to process
         * @throws Exception
         */
        public function addFolder($path);

        /**
         * Exclude a folder from the parsing
         *
         * @param string $path Folder to exclude
         * @throws Exception
         */
        public function excludeFolder($path);

        /**
         * Checks if the class has been defined
         *
         * @param string $className Name of the class
         * @return bool true if class exists, false otherwise.
         */
        public function classExists($className);

        /**
         * Set the scan options
         *
         * @param  int $options scan options.
         * @return void
         */
        public function setScanOptions($options);

        /**
         * Get the scan options.
         *
         * @return int
         */
        public function getScanOptions();

        /**
         * Method used by the spl_autoload_register
         *
         * @param string $className Name of the class
         * @return void
         */
        public function loadClass($className);

        /**
         * Returns previously registered classes
         *
         * @return array the list of registered classes
         */
        public function getRegisteredClasses();

        /**
         * Refreshes an already generated cache file
         * This solves problems with previously unexistant classes that
         * have been made available after.
         * The optimize functionnality will look at all null values of
         * the available classes and does a new parse. if it founds that
         * there are classes that has been made available, it will update
         * the file.
         *
         * @return bool true if there has been a change to the array, false otherwise
         */
        public function refresh();

        /**
         * Generate the autoload file
         *
         * @return void
         */
        public function generate();

        /**
         * Registers this autoloadManager on the SPL autoload stack.
         *
         * @return void
         */
        public function register();

        /**
         * Removes this autoloadManager from the SPL autoload stack.
         *
         * @return void
         */
        public function unregister();
    }