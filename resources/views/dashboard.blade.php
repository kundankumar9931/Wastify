<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Dashboard - Wastify Law Gate</title>
    <link rel="stylesheet" type="text/css" href="css/resident_page.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  @include ('resident_header')
    <div class="container">
        <div class="card">
            <img src="/Images/household.jpg" alt="Register My PG / House">
            <h2>Register PG / House</h2>
            <p>Register your PG, room, or apartment address to start receiving doorstep waste services.</p>
            <a href="{{ route('household.create') }}"><button>Register Now</button></a>
        </div>
        <div class="card">
            <img src="/Images/garbage_bins.jpg" alt="Report Overflowing Bin">
            <h2>Report Overflowing Bin</h2>
            <p>Spotted a full public bin in your street? Report it here to alert our area supervisors.</p>
            <a href="{{ route('complaint.create') }}"><button>Report Now</button></a>
        </div>
        <div class="card">
            <img src="/Images/subscribe.jpg" alt="Locality Cleaning Plan">
            <h2>Locality Cleaning Plan</h2>
            <p>Join the Law Gate green initiative with a monthly waste collection plan.</p>
            <a href="{{ route('subscription.create') }}"><button>Join Plan</button></a>
        </div>
        <div class="card">
            <img src="/Images/schedule.jpg" alt="Special Waste Pickup">
            <h2>Special Waste Pickup</h2>
            <p>Schedule pickups for bulky items like old furniture, electronics, or construction waste.</p>
            <a href="{{ route('user.schedule.create') }}"><button>Schedule Now</button></a>
        </div>
        <div class="card">
            <img src="/Images/payment.jpg" alt="Service Payments">
            <h2>Service Payments</h2>
            <p>Manage your monthly collection fees and view payment history.</p>
            <a href="{{ route('payment.create') }}"><button>Make Payment</button></a>
        </div>
        <div class="card">
            <img src="/Images/feedback.jpg" alt="Feedback">
            <h2>Street Feedback</h2>
            <p>Rate the cleanliness of your lane and earn reward points for helping us stay green.</p>
            <a href="{{ route('feedback.create') }}"><button>Submit Feedback</button></a>
        </div>
    </div>
    <footer>
    <div class="credit"> &copy; copyright @
      <?php echo date('Y'); ?> Wastify - Law Gate Initiative <br> All Rights Reserved <br>
    </div>
    </footer>
    <script src="{{ asset('js/menu.js') }}"></script>
</body>
</html>
