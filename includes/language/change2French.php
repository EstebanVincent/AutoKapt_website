<?php

require_once '../dataBaseHandler.inc.php';
require_once '../functions.inc.php';

changeLanguage($conn, 0);
echo $_SESSION['userLanguage'];
