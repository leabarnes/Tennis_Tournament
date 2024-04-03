<?php
include $_SERVER["DOCUMENT_ROOT"].'/Application.php';

$search_field = $_POST['search_field'];
$search_value = $_POST['search_value'];
$search_condition = $_POST["search_condition"];

$app = new Application();
$app->findTournament($search_field, $search_value, $search_condition);
