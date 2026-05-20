<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Wastify Law Gate</title>
    <link rel="stylesheet" type="text/css" href="css/homepage.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="logo"><a href="#">Wastify</a></div>
        <nav class="nav">
            <a href="#home">Home</a>
            <a href="#about">About Law Gate</a>
            <a href="#services">Services</a>
            <a href="#recycling">Recycling</a>
            <a href="#testimonials">Voices</a>
            <a href="#contact">Contact</a>
        </nav>
        <div class="right-buttons">
        <div class="right">
            <a href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket" style="color: #000000;"></i>  Sign in</a>
        </div>
        <button class="menu-button" onclick="toggleDropdownMenu()">
        <i class="fa-solid fa-caret-down" style="color: #000000;"></i>
        </button>
        </div>
        <div class="dropdown-menu">
        <a href="#home">Home</a>
        <a href="#about">About Law Gate</a>
        <a href="#services">Services</a>
        <a href="#recycling">Recycling</a>
        <a href="#testimonials">Voices</a>
        <a href="#contact">Contact</a>
    </div>
    </header>
    <section class="home" id="home">
            <div class="welcome-home">
            <h1>Wastify – Law Gate Smart Waste Management System</h1>
            <p>Cleaning up the heart of LPU's off-campus student hub.
                Serving PGs, Food Street, Market area, and Apartments.
                Schedule pickups, report overflows, and track our trucks in real-time.</p>
            <a href="{{ route('register') }}"><button>Get Started</button></a>
            </div>
            <div class="img-home">
            <img src="Images/home.jpg">
            </div>
    </section>
    <section class="about" id="about">
        <h1>Serving the Law Gate Locality</h1>
        <div class="about-intro">
            <p>Law Gate is home to thousands of LPU students and local residents living in PGs and apartments. Managing waste in this bustling commercial and residential zone requires smart solutions. Wastify is dedicated to bridging the gap between municipal services and locality needs, ensuring every lane from Food Street to the Approach Road stays clean.</p>
        </div>
        <div class="about-content">
        <div class="about-text">
            <h2>Our Mission</h2>
            <p>To provide a structured, technology-driven waste collection system for Law Gate shopkeepers and residents, reducing illegal dumping and promoting a healthier living environment.</p>
            <h2>Our Vision</h2>
            <p>To make Law Gate a model smart-locality for waste management in Punjab, leveraging community participation and real-time tracking.</p>
            <h2>Our Values</h2>
                <p><i class="fas fa-city"></i> Locality Focused</p>
                <p><i class="fas fa-store"></i> Shopkeeper Friendly</p>
                <p><i class="fas fa-users"></i> Student Support</p>
                <p><i class="fas fa-truck"></i> Efficient Logistics</p>
        </div>
        <div class="about-img">
            <img src="Images/about.jpg" alt="About us">
        </div>
        </div>
    </section>
    <section class="services" id="services">
    <h1>Our Services</h1>
        <div class="services-part1">
            <div class="service1 box">
                <h2>Residential Pickup</h2>
                <p>PG residents and apartment tenants can schedule door-to-door waste collection. Whether it's daily trash or bulky items like old furniture, we've got you covered in all lanes of Law Gate.
                </p>
                <a href="#"><button>Schedule Pickup</button></a>
            </div>
            <div class="service2 box">
                <h2>Commercial Disposal</h2>
                <p>Customized waste solutions for cafes, shops, and restaurants on Food Street. Bulk waste handling and scheduled morning pickups designed for the busy Law Gate market.
                </p>
                <a href="#"><button>Commercial Request</button></a>
            </div>
        </div>
        <div class="services-part2">
            <div class="service3 box">
                <h2>Overflow Reporting</h2>
                <p>See an overflowing public bin? Report it instantly through our app. Our area supervisors receive alerts and dispatch collectors to the hotspot immediately to maintain hygiene.
                </p>
                <a href="#"><button>Report Issue</button></a>
            </div>
            <div class="service4 box">
                <h2>Smart Fleet Tracking</h2>
                <p>Track our garbage trucks as they move through PG Street 1, Street 2, and the Main Market. Never miss a collection again with real-time ETA and location updates.
                </p>
            </div>
        </div>
    </section>
    <section class="collection-area">
        <h1>Law Gate Coverage Area</h1>
        <p>Serving Main Law Gate Market, PG Streets, Food Street, Backside Apartments, and Approach Road zones.
        </p>
        
        <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3410.5!2d75.70!3d31.255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a5f5e9c489cf3%3A0x4049a5409d53c300!2sLovely%20Professional%20University!5e0!3m2!1sen!2sin!4v1689255850937!5m2!1sen!2sin" width="640" height="480" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
    <section class="recycling" id="recycling">
        <h1>Recycling for Law Gate</h1>
        <div class="recycling-box">
        <div class="img-recycling">
            <img src="Images/recycling2.jpg" alt="Recycling">
        </div>
        <div class="recycling-importance">
            <h2>Sustainability in the Locality</h2>
            <p>With thousands of students, Law Gate generates massive amounts of paper, plastic, and food waste. Segregation at the source is key to keeping the locality sustainable. We partner with local recycling units to process your dry waste efficiently.</p>
            <p>Earn reward points for segregating your PG or Shop waste, and help Law Gate become the cleanest student hub in Phagwara.</p>
        </div>
        </div>
        <div class="recyclables">
            <div class="recyclables-intro">
            <h2>Locality Segregation Guide</h2>
            <p>How to dispose of waste in Law Gate</p>
            </div>
            <div class="recyclables-list">
            <div class="recyclable1">
                <h4>Market Waste (Blue)</h4>
                <p>Cardboard cartons from shops, delivery boxes, assignments, newspapers</p>
            </div>
            <div class="recyclable2">
                <h4>Food Street Waste (Green)</h4>
                <p>Leftover food from cafes, vegetable peels, organic kitchen waste</p>
            </div>
            <div class="recyclable3">
                <h4>PG E-Waste (Red)</h4>
                <p>Damaged mobile chargers, old earphones, batteries, expired electronics</p>
            </div>
            <div class="recyclable4">
                <h4>Plastic/Glass (Yellow)</h4>
                <p>Beverage bottles, takeaway containers, glass jars</p>
            </div>
            </div>
        </div>
    </section>
    <section class="testimonials" id="testimonials">
    <h1>Locality Voices</h1>
        <div class="ppl-testimonials">
            <div class="testimonial1">
                <img src="Images/testimonial1.png" alt="Testimonial 1">
                <p>"Managing trash in my PG used to be a nightmare. Now with Wastify, the pickup is regular and the app is so easy to use for students."</p>
                <p><span>- Aryan, Student Resident</span></p>
            </div>
            <div class="testimonial2">
                <img src="Images/testimonial2.png" alt="Testimonial 2">
                <p>"As a cafe owner on Food Street, I needed a reliable bulk waste service. Wastify's commercial plan is perfect for my business needs." </p>
                <p><span>- Mr. Gupta, Cafe Owner</span></p>
            </div>
            <div class="testimonial3">
                <img src="Images/testimonial3.png" alt="Testimonial 3">
                <p>"Tracking the truck on the narrow PG streets helps us ensure all bins are placed out on time. Great initiative for Law Gate!"
                </p>
                <p> <span>- Kamaljeet Singh, Locality Resident</span></p>
            </div>
        </div>
    </section>
    <section class="contact" id="contact">
        <h1>Contact Us</h1>
        <div>
            <p>Wastify Law Gate Helpline:</p><br>
            <p><i class="fa-solid fa-phone" style="color: #000000;"></i> Phone number: +91 98765 43210</p><br>
            <p><i class="fa-solid fa-envelope" style="color: #000000;"></i> Email address: lawgate@wastify.in</p>
        </div>
    </section>
    <footer>
    <div class="credit"> &copy; copyright @
      <?php echo date('Y'); ?> Wastify - Law Gate Initiative <br> All Rights Reserved <br>
    </div>
    </footer>
    <script src="{{ asset('js/menu.js') }}"></script>
</body>
</html>
