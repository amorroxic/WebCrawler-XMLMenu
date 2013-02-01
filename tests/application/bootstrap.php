<?php
error_reporting(E_ALL | E_STRICT);

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

define('ROOTDIR', APPLICATION_PATH. '/../');

// Define the default include path
set_include_path(PATH_SEPARATOR .
                 APPLICATION_PATH . '/library/' .
				 PATH_SEPARATOR .
                 APPLICATION_PATH . '/modules/default/models/' .
				 PATH_SEPARATOR .
                 APPLICATION_PATH . '/modules/default/controllers/'.
				 PATH_SEPARATOR .
                 '/Users/amo/Applications/phpunit/phpunit/'
				);
// var_dump(get_include_path());
// die();
require_once 'Zend/Application.php';
require_once 'ControllerTestCase.php';
