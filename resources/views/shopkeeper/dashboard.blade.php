<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopkeeper Portal - Wastify Law Gate</title>
    <link rel="stylesheet" type="text/css" href="/css/resident_page.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  @include ('resident_header')
    <div class="container">
        <div class="card">
            <img src="/Images/household.jpg" alt="Register Shop">
            <h2>Register Shop</h2>
            <p>Register your cafe, restaurant, or store in Law Gate Market to start commercial pickups.</p>
            <a href="{{ route('household.create') }}"><button>Register Now</button></a>
        </div>
        <div class="card">
            <img src="/Images/garbage_bins.jpg" alt="Daily Disposal">
            <h2>Daily Commercial Disposal</h2>
            <p>Log your daily commercial waste (Food, Packaging, Bulk) for morning collection.</p>
            <a href="#"><button>Log Waste</button></a>
        </div>
        <div class="card">
            <img src="/Images/subscribe.jpg" alt="Commercial Plan">
            <h2>Commercial Waste Plan</h2>
            <p>Manage your business waste subscription tailored for high-volume cafe and shop needs.</p>
            <a href="{{ route('subscription.create') }}"><button>Manage Plan</button></a>
        </div>
        <div class="card">
            <img src="/Images/schedule.jpg" alt="Bulk Waste Request">
            <h2>Bulk Waste Request</h2>
            <p>Request special pickups for large cardboard cartons, furniture, or seasonal shop waste.</p>
            <a href="{{ route('user.schedule.create') }}"><button>Request Pickup</button></a>
        </div>
        <div class="card">
            <img src="/Images/payment.jpg" alt="Business Payments">
            <h2>Business Payments</h2>
            <p>Pay your commercial waste collection invoices and track billing history.</p>
            <a href="{{ route('payment.create') }}"><button>Pay Invoices</button></a>
        </div>
        <div class="card">
            <img src="/Images/feedback.jpg" alt="Market Hygiene">
            <h2>Market Hygiene Feedback</h2>
            <p>Report issues in the market area or provide feedback on collection efficiency.</p>
            <a href="{{ route('feedback.create') }}"><button>Submit Feedback</button></a>
        </div>
    </div>
    <footer>
    <div class="credit"> &copy; copyright @
      <?php echo date('Y'); ?> Wastify - Law Gate Business Portal <br> All Rights Reserved <br>
    </div>
    </footer>
    <script src="{{ asset('js/menu.js') }}"></script>
</body>
</html>
