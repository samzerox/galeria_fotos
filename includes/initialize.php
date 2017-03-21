<?php

defined("SD") ? NULL : define("SD", DIRECTORY_SEPARATOR);
defined("RAIZ_DIR") ? NULL : define("RAIZ_DIR", "C:" . SD . "xampp" . SD . "htdocs" . SD . "galeria_fotos");
defined("LIB_DIR") ? NULL : define("LIB_DIR", RAIZ_DIR . SD . "includes");

require_once(LIB_DIR . SD . "config.php");
require_once(LIB_DIR . SD . "functions.php");
require_once(LIB_DIR . SD . "database.php");
require_once(LIB_DIR . SD . "database_table.php");
require_once(LIB_DIR . SD . "pagination.php");
//
require_once(LIB_DIR . SD . "user.php");
require_once(LIB_DIR . SD . "photo.php");
require_once(LIB_DIR . SD . "comment.php");
//
require_once(LIB_DIR . SD . "session.php");

?>