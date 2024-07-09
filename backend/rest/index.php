<?php

require "../vendor/autoload.php";
require "./services/ExamService.php";
require_once dirname(__FILE__)."/dao/ExamDao.php";

Flight::register('examService', 'ExamService');

require 'routes/ExamRoutes.php';

Flight::start();
 ?>
