<?php
define ( 'ROOT_PATH', dirname ( dirname ( dirname ( __DIR__ ) ) ) . '/' );
define ( 'LIB_PATH', ROOT_PATH . 'lib/' );
define ( 'LIB_BASE_PATH', LIB_PATH . 'base/' );
define ( 'LIB_EXT_PATH', LIB_PATH . 'ext/' );
define ( 'CACHE_PATH', ROOT_PATH . 'data/cache/' );
define ( 'CONFIG_PATH', ROOT_PATH . 'data/config/' );

/*
define ( 'APP_PATH', ROOT_PATH . loadRouter::getInstance ()->module . '/' );
define ( 'APP_CONTROLLER_PATH', APP_PATH . 'controller/' );
define ( 'APP_MODEL_PATH', APP_PATH . 'model/' );
define ( 'APP_VIEW_PATH', APP_PATH . 'view/' );
*/