<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
<?php

    function echo_paragraph($valueToPrint){
        echo "<p>$valueToPrint</p>";

    }

    // echo_paragraph($_POST['meatInput1']);
    // echo_paragraph($_POST['meatTemp']);

    // echo_paragraph(isset($_POST['meatCheck'])); 
    // //The Checkbox requires isset in order to accuratley check on/off
    
    // echo_paragraph($_POST['meatRadios']);
    // echo_paragraph($_POST['meatCat']);

    $name = $_POST["meatInput1"];
    $doneness = $_POST["meatTemp"];
    $isEdible = $_POST["meatCheck"];
    $isWhiteMeat = $_POST["meatRadios"];
    $meatCategory = $_POST["meatCat"];




    if(isset($_POST["meatCheck"])){
        $isWhiteMeat = 1;
    }
    else{
        $isWhiteMeat = 0;
    }

    try{
        $dsn = 'mysql:dbname=fooddb;host=localhost';
        $user = 'Arbys';
        $password = 'havemeats';

        $dbh = new PDO($dsn, $user, $password);
        $sql = "INSERT INTO meat ( 
            s_name,
            s_doneness,
            b_edible_raw,
            b_white,
            s_category
            )
            VALUES (
                :name,
                :doneness,
                :isEdible,
                :isWhiteMeat,
                :meatCategory
                )";

        $sth = $dbh->prepare($sql);

        $sth->execute([
            ":name" => $name,
            "doneness" => $doneness,
            "isEdible" => $isEdible,
            "isWhiteMeat" => $isWhiteMeat,
            "meatCategory" => $meatCategory
        ]);

        echo "<h2>Record Created</h2>";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


?>
</div>
</body>
</html>

