<?php
    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
    $servername = "capstone.cfwnz1g6jqbd.us-east-1.rds.amazonaws.com:3306";
    $username = "admin";
    $password = "SixGuys1CapstoneProject";
    $dbname="Capstone";
    $conn = new mysqli($servername, $username, $password,$dbname);

    $sendEmail=$_POST["sendEmail"];
    $sendMessage=$_POST["sendMessage"];
    $numS=rand(7,1000);
    $sql='INSERT INTO WebInfo(HitID,contactEmail,contactMessage)Values('.$numS.',"'.$sendEmail.'","'.$sendMessage.'")';
    //console_log($sql);
    $result=$conn->query($sql);
    //console_log($result);
    echo '<script>window.location.replace("/");</script>';
?>