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
    $sql='INSERT INTO WebInfo(contactEmail,contactMessage)Values("'.$sendEmail.'","'.$sendMessage.'")';
    $result=$conn->query($sql);
    echo '<script>window.location.replace("/");</script>';
?>