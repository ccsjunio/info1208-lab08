<?php
define("_ROOTFOLDER_", $_SERVER['DOCUMENT_ROOT']);

// if holding posts have no value and was not defined
// redirect to error page
// when no checkbox is marked no array is sent 
// from the form
if(!isset($_POST['holding'])){
    header("Location:".$_SERVER['REMOTE_HOST']."/views/204.php");
}

// include functions file statements
include_once _ROOTFOLDER_."/utils/lab8_carlos_ferraz_functions.php";

    require_once _ROOTFOLDER_."/data/data.php";

    $sanitizedPosting = sanitizeArray($_POST['holding']);
    $holdingsPosted = $sanitizedPosting ? $sanitizedPosting : false;

    if(!$holdingsPosted){
        header("Location:".$_SERVER['REMOTE_HOST']."/views/406.php");
    }

    $holdingsDeclared = array();

    $holdingsMarkup = "";

    $columnsPerRow = 3;
    $row = 1;
    $column = 1;
    $counter = 1;

    foreach($holdingsPosted as $key=>$id){
        if($column===1){
            $holdingsMarkup .= '<div class="row">';
        }

        $holdingName = ($holdings[$id]['name']);
        $holdingImage = $_SERVER['HTTP_REFERER']."/img/".$holdings[$id]['image'];

        $holdingName = undefinedArticleTo($holdingName) . " " . $holdingName;

        $holdingsMarkup .= <<<EOF
            <div class="col">
                <div class="card">
                    <img class="mx-auto" src="$holdingImage"/>
                    <div class="card-body">
                        <h5 class="card-title">$holdingName</h5>
                        <p class="card-text"></p>
                        <p class="card-text"><small class="text-muted"></small></p>
                    </div>
                </div> 
            </div>
        EOF;

        // end row markup if line ends
        if($column===$columnsPerRow || ++$counter===count($holdingsPosted)){
            $holdingsMarkup .= '</div>';
        }

        // if the columns are at maximum
        // change row
        if(++$column>$columnsPerRow){
            $row++;
            $column=1;
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

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Dump of data received through POST:</h1>
        </div>
    </div>

    <div class="container variableDump">
        <?php print_r($_POST); ?>
    </div>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">About mysqli_connect():</h1>
        </div>
    </div>

    <div class="container variableDump">
        <?php 
            if(function_exists('mysqli_connect')){
                echo "Function mysqli_connect is avalable";
            } else {
                echo "Function mysqli_connect is not available. Yay!";
            }

        ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
    </body>
</html>
