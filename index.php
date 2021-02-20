<?php

//Turn on error reporting -- this is critical!
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//Default Route
$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a survey route
$f3->route('GET /survey', function() {

    //var_dump($_SESSION);

    $view = new Template();
    echo $view->render('views/survey.html');
});

//Define the summary page route
$f3->route('POST /summary', function() {

    //var_dump($_SESSION);

    if(isset($_POST['fName'])){
        $_SESSION['fName'] = $_POST['fName'];
    }

    if (isset($_POST['interests'])) {
        $interest = $_POST['interests'];
        $_SESSION['interests'] = implode(", ", $interest);

    }

    $view = new Template();
    echo $view->render('views/summary.html');

    //Clear the SESSION array
    session_destroy();
});


//Run fat free
$f3->run();