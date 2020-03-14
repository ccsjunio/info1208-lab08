<?php
define("_ROOTFOLDER_", $_SERVER['DOCUMENT_ROOT']);

// if holding posts have no value and was not defined
// redirect to error page
// when no checkbox is marked no array is sent 
// from the form
if(!array_key_exists("holding",$_POST)){
    header("Location:http://".$_SERVER['SERVER_NAME']."/views/204.php");
    die();
}

// include functions file statements
include_once _ROOTFOLDER_."/utils/lab8_carlos_ferraz_functions.php";
// include holdings data from database file
include_once _ROOTFOLDER_."/data/data.php";

    $sanitizedPosting = sanitizeArray($_POST['holding']);
    $holdingsPosted = $sanitizedPosting ? $sanitizedPosting : false;

    if(!$holdingsPosted){
        header("Location:".$_SERVER['SERVER_NAME']."/views/406.php");
    }

    // variable to hold the holdings markup to be displayed
    $holdingsMarkup = "";

    // number of columns of holdings per row
    $columnsPerRow = 3;
    //initialize rows, columns and holding counter
    $row = 1;
    $column = 1;
    $counter = 1;

    // iterate for the clean holdings posted array to build
    // the markup
    foreach($holdingsPosted as $key=>$id){
        // if the row is beginning, build the correct 
        // bootstrap markup for it
        if($column===1){
            $holdingsMarkup .= '<div class="row">';
        }

        // load variables with the holdings properties
        $holdingName = ($holdings[$id]['name']);
        $holdingImage = $_SERVER['HTTP_REFERER']."/img/".$holdings[$id]['image'];
        // build the correct undefined article for the
        // holding noun
        $holdingName = undefinedArticleTo($holdingName) . " " . $holdingName;

        // build the holding markup for this iteration
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
        if($column===$columnsPerRow || ++$counter===count($holdingsPosted) || count($holdingsPosted)===1 ){
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
                echo "Function mysqli_connect is avalable! Yay!";
            } else {
                echo "Function mysqli_connect is not available.";
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
