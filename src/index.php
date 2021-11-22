<?php
session_unset();
require_once  'controller/Controller.php';
$controller = new Controller();
$controller->mvcHandler();
