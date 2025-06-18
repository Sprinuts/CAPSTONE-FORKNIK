<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="{{ asset('style/about.css', true) }}"> <!-- Link to the CSS -->
</head>
<body>

    <!-- Include the navbar at the top -->

    <!-- Main content container -->
    <div class="about-container">
        <h1>ABOUT US</h1>
        <h1 style="font-weight: bold; font-size: 3.5em; color: #0c7e10; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); letter-spacing: 2px;">FORKNIK</h1>
        <p style="font-size: 1.2em; margin-top: 15px; line-height: 1.6; color: #555; margin-top:25px; margin-bottom:60px;">
            <span style="color: green; font-weight: bold;">FORKNIK</span> is a team of innovative developers committed to delivering an efficient and user-friendly equipment
            management website for our school's IT Services Office (ITSO). Designed to streamline user management, 
            equipment tracking, and borrowing workflows, it empowers ITSO personnel, associates, and students 
            with reliable and seamless operations.
        </p>

        <!-- Team Members Section -->
        <div class="team">
            <div class="member">
                <img src="{{ asset('style/assets/Jaybe.jpg', true) }}" alt="Jaybert Gao">
                <h2>Malvin Jaybert Gao</h2>
                <h5>Lead Programmer</h5>
                <p>Responsible for designing and implementing the core functionalities of the website, ensuring a robust and efficient system that meets the needs of the IT Services Office (ITSO).</p>
            </div>
            <div class="member">
                <img src="{{ asset('style/assets/AAron.jpg', true) }}" alt="Aaron Sansaet">
                <h2>Lance Aaron Sansaet</h2>
                <h5>Front End Developer</h5>
                <p>As a Front-End Developer, Aaron ensures the website's design is visually appealing and responsive, providing users with an intuitive and engaging experience. </p>
                </div>
            <div class="member">
                <img src="{{ asset('style/assets/Me.jpg', true) }}" alt="Ivan Baranda">
                <h2>Ivan Baranda</h2>
                <h5>Front End Assistant</h5>
                <p>As the Front-End Assistant, Ivan supports the development and implementation of the website's user interface by handling minor adjustments and ensuring the website's consistency.</p>
            </div>
            <div class="member">
                <img src="{{ asset('style/assets/Josh.jpg'. true) }}" alt="Josh Valerio">
                <h2>Josh Abraham Valerio</h2>
                <h5>Quality Assurace</h5>
                <p>As the Quality Assurance, Josh ensures the website is functional, reliable, and accesssible by identifying issues and collaborating with the team to deliver a seamless experience.</p>
                </div>
        </div>
    </div>

</body>
</html>