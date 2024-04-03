<?php
include 'Application';

$app = new Application();
try{
    $app->startRandomTournament();
} catch(Exception $e){
    echo $e->getMessage();
}