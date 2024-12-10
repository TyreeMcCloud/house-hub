<?php // clear session when going home
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Hub</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <header>
        <div class="banner">
            <div class="logo">
                <h1>House Hub</h1>
            </div>
            <nav>
                <a href="registration.php">Register</a>
                <a href="login.php">Login</a>
            </nav>
            <div class="user-info">
            <p>Please login or register to continue</p>
            </div>
        </div>
    </header>
    <main>
    <section>
        <h1 align="center">About Us</h1>
        <p>We provide a platform where buyers and sellers can connect to buy and sell properties. Our mission is to speed up the real estate process by eliminating unnecessary intermediaries, making property transactions more transparent, efficient, and affordable.</p>
    </section>
    <section>
        <h2>What We Do</h2>
        <p>House Hub connects property buyers with sellers through an easy-to-use Website. Whether you’re looking to buy your dream home or sell your property fast, we ensure an experience with tools to browse and directly buy homes.</p>
        <img src="images/home.png" alt="home-img">
    </section>

    <section>
        <h2>Our Services</h2>
        <ul>
            <li><strong>Property Listings:</strong> Post and browse detailed property listings with photos, descriptions, and pricing.</li>
            <li><strong>Messaging:</strong> Communicate directly with buyers or sellers through our secure messaging platform.</li>
            <li><strong>Tours:</strong> Request a tour with the seller to come see the home in person.</li>
        </ul>
    </section> <br>

    <section>
        <h2>Why Choose Us?</h2>
        <p>At House Hub, we prioritize efficiency, affordability, and transparency. Here's why we stand out from competitors:</p>
        <ul>
            <li><strong>User-Friendly Interface:</strong> Simple design and features to save you time and effort.</li>
            <li><strong>Direct Communication:</strong> No middlemen – you deal directly with buyers or sellers.</li>
        </ul>
    </section> <br>

    <section>
        <h2>How We Attract Customers</h2>
        <p>We strive to provide value to our users through innovative and modern strategies:</p>
        <ul>
            <li><strong>Promotions:</strong> We offer limited time deals on property listings.</li>
            <li><strong>Social Media:</strong> We use platforms like Instagram for successful stories and property highlights.</li>
            <li><strong>Educational Resources:</strong> Blogs, webinars, and guides on buying or selling properties to educate our users.</li>
        </ul>
    </section>
    <a href="registration.php" class="register-link">REGISTER TODAY!</a>
</main>

</body>
</html>

