<?php
echo "200 Ok!";
die;
include 'Application';

$app = new Application();
$app->startRandomTournament();