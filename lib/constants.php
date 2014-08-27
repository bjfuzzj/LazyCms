<?php

/**
 * [广西广电网络 CMS] (C)2014-2024 www.96335.com
 * This is NOT a freeware, use is subject to license terms
 *
 * $Id: constants.php 2012/9/3  $
 */

!defined('PATH_ROOT') && exit('Forbidden');

defined('PATH_LIB') || define('PATH_LIB', PATH_ROOT . '/lib');
defined('PATH_MODULE') || define('PATH_MODULE', PATH_ROOT . '/module');
defined('PATH_CONTROLLER') || define('PATH_CONTROLLER', PATH_ROOT . '/controller');
defined('PATH_DATA') || define('PATH_DATA', PATH_ROOT . '/data');
defined('PATH_PLUGIN') || define('PATH_PLUGIN', PATH_ROOT . '/plugin');
defined('PATH_UPFILE') || define('PATH_UPFILE', '/uploadfile');
defined('PATH_UPLOAD') || define('PATH_UPLOAD', PATH_ROOT . PATH_UPFILE);

defined('PATH_TPLS') || define('PATH_TPLS', PATH_ROOT . '/template');
defined('PATH_TPLS_COMPILE') || define('PATH_TPLS_COMPILE', PATH_ROOT . '/data/compile');
defined('PATH_TPLS_CACHE') || define('PATH_TPLS_CACHE', PATH_ROOT . '/data/cache');
defined('PATH_TPLS_ADMIN') || define('PATH_TPLS_ADMIN', PATH_TPLS . '/admin');
defined('PATH_TPLS_MAIN') || define('PATH_TPLS_MAIN', PATH_TPLS . '/default');
defined('PATH_COOKIE') || define('PATH_COOKIE',  '/');

defined('PAGE_ROWS') || define('PAGE_ROWS', 30);
defined('PAGE_ROWS_ADMIN') || define('PAGE_ROWS_ADMIN', 30);

defined('CUR_VERSION') || define('CUR_VERSION', '2.1');
defined('SOURCE_URL') || define('SOURCE_URL', 'http://www.96335.com/');
