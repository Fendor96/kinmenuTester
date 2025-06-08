<?php 

    
function error_logs($message){
    $date =  date("Y-m-d H:i:s");
    file_put_contents('error_log.txt'," [$date] $message" . PHP_EOL, FILE_APPEND);
}



?>