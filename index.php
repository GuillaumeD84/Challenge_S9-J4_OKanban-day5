<?php

require_once 'utils/AltoRouter.php';
require_once 'utils/Database.php';
require_once 'Applications.php';

require_once 'models/CardModel.php';
require_once 'models/ListModel.php';
require_once 'models/TaskModel.php';

$connection = Database::getDB();

$app = new Application();
$app->run();
