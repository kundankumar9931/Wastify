<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Plans | Wastify India</title>
    <link rel="stylesheet" type="text/css" href="/css/resident_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap');

        :root {
            --primary: #28a745;
            --secondary: #292929;
            --light-bg: #f4f7f6;
            --white: #ffffff;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            padding: 0;
            color: var(--secondary);
        }

        .pricing-header {
            text-align: center;
            padding: 120px 20px 60px; /* Increased top padding for fixed header */
            background: linear-gradient(135deg, #1e1e1e 0%, #292929 100%);
            color: white;
        }

        .pricing-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .pricing-container {
            max-width: 1000px;
            margin: -50px auto 50px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding: 0 20px;
        }

        .pricing-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 300px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .pricing-card.popular {
            border: 2px solid var(--primary);
        }

        .popular-badge {
            background: var(--primary);
            color: white;
            padding: 5px 20px;
            position: absolute;
            top: 20px;
            right: -30px;
            transform: rotate(45deg);
            font-size: 0.8rem;
            font-weight: bold;
        }

        .plan-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .plan-price {
            font-size: 3rem;
            font-weight: 700;
            margin: 20px 0;
        }

        .plan-price span {
            font-size: 1rem;
            color: #999;
            font-weight: normal;
        }

        .plan-features {
            list-style: none;
            padding: 0;
            margin: 30px 0;
            text-align: left;
            flex-grow: 1;
        }

        .plan-features li {
            margin-bottom: 15px;
            color: #555;
            display: flex;
            align-items: center;
        }

        .plan-features li i {
            color: var(--primary);
            margin-right: 10px;
        }

        .btn-subscribe {
            background: var(--secondary);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
            display: block;
        }

        .btn-subscribe:hover {
            background: #444;
        }

        .pricing-card.popular .btn-subscribe {
            background: var(--primary);
        }

        .pricing-card.popular .btn-subscribe:hover {
            background: #218838;
        }

        footer {
            text-align: center;
            padding: 40px;
            color: #888;
        }

        /* Hidden form inputs */
        .hidden-form {
            display: none;
        }
    </style>
</head>
<body>
    @include ('resident_header')

    <div class="pricing-header">
        <h1>Wastify Smart Plans</h1>
        <p>Keeping Law Gate Clean & Sustainable</p>
    </div>

    <div class="pricing-container">
        <!-- Monthly Plan -->
        <div class="pricing-card">
            <div class="plan-name">Standard</div>
            <div class="plan-price">₹100<span>/month</span></div>
            <ul class="plan-features">
                <li><i class="fas fa-check-circle"></i> Daily Doorstep Pickup</li>
                <li><i class="fas fa-check-circle"></i> Segregated Waste Collection</li>
                <li><i class="fas fa-check-circle"></i> Basic Support</li>
                <li><i class="fas fa-check-circle"></i> Mobile App Access</li>
            </ul>
            <form action="{{ route('subscription.store') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="monthly">
                <input type="hidden" name="start_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="end_date" value="{{ date('Y-m-d', strtotime('+1 month')) }}">
                <button type="submit" class="btn-subscribe">Get Started</button>
            </form>
        </div>

        <!-- Yearly Plan -->
        <div class="pricing-card popular">
            <div class="popular-badge">Best Value</div>
            <div class="plan-name">Annual Pro</div>
            <div class="plan-price">₹1099<span>/year</span></div>
            <ul class="plan-features">
                <li><i class="fas fa-check-circle"></i> Everything in Monthly</li>
                <li><i class="fas fa-check-circle"></i> 1 Month Free (Save ₹101)</li>
                <li><i class="fas fa-check-circle"></i> Priority Pickup Support</li>
                <li><i class="fas fa-check-circle"></i> Smart Bin Request Access</li>
            </ul>
            <form action="{{ route('subscription.store') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="yearly">
                <input type="hidden" name="start_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="end_date" value="{{ date('Y-m-d', strtotime('+1 year')) }}">
                <button type="submit" class="btn-subscribe">Go Annual Pro</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Wastify India - Law Gate Smart Waste Management</p>
        <p><small>Terms of Service & Privacy Policy apply.</small></p>
    </footer>

    <script src="{{ asset('js/menu.js') }}"></script>
</body>
</html>
