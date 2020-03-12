<?php

define("_ROOTFOLDER_", $_SERVER['DOCUMENT_ROOT']);    

// if holding posts have no value and was not defined
// redirect to error page
// when no checkbox is marked no array is sent 
// from the form
if(!isset($_POST['holding'])){
    header("Location:".$_SERVER['REMOTE_HOST']."/views/404.php");
}

// include functions file statements
include _ROOTFOLDER_."/utils/lab8_carlos_ferraz_functions.php";

    require_once _ROOTFOLDER_."/data/data.php";

    $holdingsPosted = $_POST['holding'];
    $holdingsDeclared = array();

    $holdingsMarkup = "";

    $columnsPerRow = 3;
    $row = 1;
    $column = 1;

    foreach($holdingsPosted as $key=>$id){
        echo "key=$key and value=$id";
        if($column===1){
            $holdingsMarkup .= '<div class="row">';
        }

        $holdingName = ($holdings[$id]['name']);
        $holdingImage = $_SERVER['REMOTE_HOST']."/img/".$holdings[$id]['image'];

        $holdingsMarkup .= <<<EOF
        
            <div class="col-sm">
                <div class="card">
                    <img src="$holdingImage" width="300"/>
                    <div class="card-body">
                    <h5 class="card-title">$holdingName</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                
            </div>
        EOF;

        if($column===$columnsPerRow){
            $holdingsMarkup .= '</div>';
        }

        if(++$column>$columnsPerRow){
            $row++;
        }
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/main.css"/>
    
    <script src="https://kit.fontawesome.com/5163503c2c.js" crossorigin="anonymous"></script>

    <title>INFO 1208 - LAB08</title>
  </head>
  <body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">The user owns:</h1>
        </div>
    </div>

    <div class="container">
        
        <!-- include markup for the holdings choices -->
        <?php echo $holdingsMarkup; ?> 
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
    </body>
</html>
