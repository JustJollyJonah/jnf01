<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Webpagina Framework</title>
        <link rel="stylesheet" href="Style.css">
    </head>
    <body>

        <div class="header">
            <p>test test test</p>
        </div>
        <div class="navbar">
            <?php
            $navbar = file_get_contents("navbar.txt");
            echo $navbar;
            ?>
        </div>

        <div class="wrapper">
            <div class="banner_left"></div>
            <div class="content">
                <pre><?php
                    $home = file_get_contents("home.txt");
                    echo $home;
                    ?>
                </pre>
            </div>
            <div class="banner_right"></div>
        </div>
        
        <div class="footer">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="about.php">Over Dynamiek ateliers</a></li>
                <li><a href="product.php">Accesoires en producten</a></li>
                <li><a href="workshop.php">Workshops</a></li>
                <li>Webshop</li>
            </ul>
        </div>
    </body>
</html>