<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Webpagina Framework</title>
        <link rel="stylesheet" href="Style_chris_1.css">
        <!--<link rel="stylesheet" href="stylejonah.css">-->
    </head>
    <body>

        <div class="header">
            <p>test test test</p>
        </div>
        <div class="navbar">
            <?php
            header('Content-Type: text/html; charset=ISO-8859-1');
            include("DatabaseFunctions.php");

            $contents = array("home"=>"home.txt", "about"=>"about.txt", "product"=>"product.txt", "workshops"=>"workshops.txt");

            $navbar = file_get_contents("navbar.txt");
            echo $navbar;

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "home";
            }
            header('Location: indexLayout3.php');
            ?>
        </div>

        <div class="wrapper">
			<div class="banner_left">
                .
            </div>
            <div class="content">
                <pre class="contents" width=167><?php
                    $content = file_get_contents($contents[$page]);
                    echo $content;

//                     $pdo = connectToServer("mysql:host=localhost;port=3307", "root", "usbw");
//                     selectDatabase($pdo, "cursus");
                    
//                     fetchFromDatabase($pdo, "cursus", "omschrijving", "testdata");
//                     fetchWithException($pdo, "cursus", "omschrijving", "omschrijving LIKE '%SQL%'", "testdata");
//                     $toFetch = array("code","omschrijving");
//                     fetchMultiple($pdo, "cursus", $toFetch, "testdata", "testdata2");
                    ?>
                </pre>
            </div>
            <div class="banner_right">
                .
            </div>
        </div>

        <div class="footer">
            <ul>
                <li><a href="index.php?page=0">Home</a></li>
                <li><a href="index.php?page=1">Over Dynamiek ateliers</a></li>
                <li><a href="index.php?page=2">Accesoires en producten</a></li>
                <li><a href="index.php?page=3">Workshops</a></li>
                <li><a href="">Webshop</a></li>
            </ul>
        </div>
    </body>
</html>
