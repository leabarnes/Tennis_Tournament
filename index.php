<?php
define('BASE_DIR', __DIR__);
include 'Application.php';

$app = new Application();
try{
    $app->startRandomTournament();
} catch(Exception $e){
    echo $e->getMessage();
}
?>
<html>
    <body>
        Hi!
    </body>
</html>