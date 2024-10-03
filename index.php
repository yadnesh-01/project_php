<?php 
try {
    include('user/includes/header.php');
    include('navbar.php');
} catch (Exception $e) {
    // Handle errors with including the header or navbar
    echo "<p>Error loading page components: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit(); // Stop further execution if header or navbar fails
}   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1" />
    <title>Restro-Book</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style1.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="header-info-par">
                <a href="user/login.php" class="showcase-button">Book Now</a>
            </div>
            <div class="video">
                <video id="video" autoplay loop muted>
                    <source src="images/video/video1.mp4" type="video/mp4" />
                </video>
            </div>
        </div>
    </header>

    <br>

    <!-- Client Section Starts -->
    <section align="center">
        <div class="container">
            <h2 align-text="center"> <b>Our Clients</b> </h2><br>
            <div class="row">
                <div class="filter-gal-par">
                    <div class="gallery-item filter diving">
                        <figure>
                            <img src="images/clients/sar.jpg" alt="" class="img-responsive"><br>
                            <figcaption> <b>Sarangi Pure Veg </b></figcaption>
                        </figure>
                    </div>
                    <div class="gallery-item filter diving">
                        <figure>
                            <img src="images/clients/ramkrushn.jpg" alt="" class="img-responsive"><br>
                            <figcaption><b> Hotel Ramkrishn Executive </b></figcaption>
                        </figure>
                    </div>
                    <div class="gallery-item filter diving">
                        <figure>
                            <img src="images/clients/open.jpg" alt="" class="img-responsive"><br>
                            <figcaption> <b>Hotel Nikita </b></figcaption>
                        </figure>
                    </div>
                    <div class="gallery-item filter diving">
                        <figure>
                            <img src="images/clients/sayaji.jpg" alt="" class="img-responsive"><br>
                            <figcaption> <b>Sayaji </b></figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section Starts -->
    <section id="blog">
        <div class="container">
            <h3>News and Articles</h3>
            <div class="blog-par">
                <div class="blog-content">
                    <div class="blog-info-par">
                        <ul>
                            <li>MedicalNewsToday</li>
                            <li>July 29,2022</li>
                        </ul>
                        <a href="https://www.medicalnewstoday.com/articles/322268">
                            <h4>What are the benefits of eating healthy?</h4>
                            <p>Healthy eating has many benefits, such as reducing the risk of heart disease, stroke, obesity, and type 2 diabetes. A person may also boost their mood and gain more energy by maintaining a balanced diet....</p>
                        </a>
                    </div>
                </div> 
            </div>
            <div class="blog-par">
                <div class="blog-content">
                    <div class="blog-info-par">
                        <ul>
                            <li>Nature Benefits</li>
                            <li>December 06,2017</li>
                        </ul>
                        <a href="https://www.nature.com/articles/s41598-017-17262-9">
                            <h4>Healthy food choices are happy food choices</h4>
                            <p>Evidence from a real life sample using smartphone based assessments ..</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Starts-->
    <footer>
        <p class="copyright">Copyright © 2024 Modified by RestroBook</p>
    </footer>

</body>

</html>

<?php 
try {
    include('user/includes/footer.php');
} catch (Exception $e) {
    // Handle errors with including the footer
    echo "<p>Error loading footer: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
