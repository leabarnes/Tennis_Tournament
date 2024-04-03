<?php
include $_SERVER["DOCUMENT_ROOT"].'/Application.php';

$app = new Application();
if(isset($_POST['player_list'])){
    try{
        $app->startListTournament();
    } catch(Exception $e){
        echo $e->getMessage();
    }
    return;
}
$num_players = $_POST['num_players'];
$gender = $_POST["gender"];
$random = isset($_POST["random"]);

if(!$num_players || !$gender){
    echo "Missing Arguments";
    return;
}

try{
    if($random){
        $app->startRandomTournament($num_players, $gender);
    } else {
        $app->startSequentialTournament($num_players, $gender);
    }
} catch(Exception $e){
    echo $e->getMessage();
}