<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    define("__OUTPUTFILE","/lab8_carlos_ferraz_output.php");
    define("_ROOTFOLDER_",$_SERVER['DOCUMENT_ROOT']);

    require_once _ROOTFOLDER_."/data/data.php";

    // define markup for holdings checkboxs within the form
    $holdingChoicesMarkup = "";

    foreach ($holdings as $holding) {

        //get holding information
        $holdingId      = $holding['id'];
        $holdingName    = $holding['name'];
        $holdingPicture = $holding['image'];
        $holdingIcon    = $holding['icon'];

        // identifies if the holding name initiates with a vowel
        // in order to agree with the article
        $pattern = '/^[aeiou]/';
        $article = preg_match($pattern,$holdingName)===0 ? "a" : "an";

        // markup template changing only the variables
        $markup = <<<EOF
            <div class="form-group row">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="$holdingId" name="holding[]" value="$holdingId">
                    <label class="custom-control-label" for="holdingCheck$holdingId"><i class="fas $holdingIcon"></i>I have $article $holdingName</label>
                </div>
            </div>
        EOF;

        // adding markup from this holding to the main markup
        $holdingChoicesMarkup .= $markup;

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
            <h1 class="display-4">Tell us about your Holdings</h1>
            <p class="lead">Don't worry, this information will not be disclosed and will remain anonymous</p>
        </div>
    </div>

    <form class="container" action="<?php echo __OUTPUTFILE; ?>" method="POST">
        <!-- include markup for the holdings choices -->
        <?php echo $holdingChoicesMarkup; ?> 

        <button type="submit" class="btn btn-primary">submit</button>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>