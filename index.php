<?php
    echo "<title>Personal website</title>";
    echo "<link rel='stylesheet' type='text/css' href='css/Styles.css'>";

    echo "<div>";
        include_once('html/header.html');
    echo "</div>";

    echo "<div>";                
        include_once("controller/controller.php");
        $controller = new Controller();
        $controller->getWeb(); 
    echo "</div>";    

    echo "<div>";
       include_once('html/footer.html');
    echo "</div>";
?>
