<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment | Wastify India</title>
    <link rel="stylesheet" type="text/css" href="/css/resident_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap');

        .payment-wrapper {
            max-width: 600px;
            margin: 100px auto 50px; /* Reduced gap between header and card */
            padding: 0 20px;
            font-family: 'Outfit', sans-serif;
        }
        .confirm-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f4f4f4;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        .detail-label {
            color: #666;
        }
        .detail-value {
            font-weight: 600;
            text-align: right;
        }
        .plan-summary {
            background: #f8fff9;
            border: 1px solid #e0f2e3;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
        }
        .total-amount {
            font-size: 2rem;
            font-weight: 700;
            color: #28a745;
            text-align: center;
            margin: 30px 0;
        }
        .btn-pay-now {
            background: #292929;
            color: white;
            padding: 18px;
            border: none;
            border-radius: 12px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: transform 0.2s, background 0.3s;
            margin-bottom: 15px;
        }
        .btn-pay-now:hover {
            background: #000;
            transform: scale(1.02);
        }
        .btn-cash {
            background: transparent;
            color: #666;
            padding: 12px;
            border: 2px solid #eee;
            border-radius: 12px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-cash:hover {
            border-color: #ccc;
            color: #333;
        }
        .badge-verified {
            font-size: 0.8rem;
            background: #d4edda;
            color: #155724;
            padding: 4px 10px;
            border-radius: 20px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    @include ('resident_header')

    <div class="payment-wrapper">
        <div class="confirm-card">
            <div class="section-title">
                Review & Confirm
                <span class="badge-verified"><i class="fas fa-shield-alt"></i> Secure Payment</span>
            </div>

            <!-- User Details -->
            <div class="detail-row">
                <span class="detail-label">Name</span>
                <span class="detail-value">{{ $user->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email</span>
                <span class="detail-value">{{ $user->email }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Location</span>
                <span class="detail-value">{{ $household->household_name ?? 'Not Registered' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Address</span>
                <span class="detail-value" style="font-size: 0.9rem; max-width: 60%;">{{ $household->location ?? 'Please register location' }}</span>
            </div>

            <!-- Plan Summary -->
            <div class="plan-summary">
                <div class="detail-row" style="margin-bottom: 5px;">
                    <span class="detail-label">Selected Plan</span>
                    <span class="detail-value" style="color: #28a745;">{{ ucfirst($plan) }}</span>
                </div>
                <div class="detail-row" style="margin-bottom: 0;">
                    <span class="detail-label">Period</span>
                    <span class="detail-value">{{ $plan === 'monthly' ? '30 Days' : '365 Days' }}</span>
                </div>
            </div>

            <div class="total-amount">
                ₹{{ number_format($cost, 2) }}
            </div>

            <!-- Payment Actions -->
            <form action="{{ route('payment.razorpay') }}" method="POST" id="razorpay-form">
                @csrf
                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                <input type="hidden" name="amount" value="{{ $cost }}">
                <button type="button" id="rzp-button" class="btn-pay-now">
                    <i class="fas fa-credit-card"></i> Pay with Razorpay
                </button>
            </form>

            <form action="{{ route('payment.store') }}" method="POST">
                @csrf
                <input type="hidden" name="subscription" value="{{ $cost }}">
                <input type="hidden" name="method" value="cash">
                <input type="hidden" name="paymentDate" value="{{ date('Y-m-d') }}">
                <button type="submit" class="btn-cash">
                    <i class="fas fa-money-bill-wave"></i> Pay Cash on Pickup
                </button>
            </form>

            <p style="text-align: center; color: #999; font-size: 0.8rem; margin-top: 20px;">
                By clicking pay, you agree to our Terms of Service for Law Gate locality waste collection.
            </p>
        </div>
    </div>

    <script>
        document.getElementById('rzp-button').onclick = function(e){
            var options = {
                "key": "{{ env('RAZORPAY_KEY_ID') }}",
                "amount": {{ $cost * 100 }}, // Amount in paise
                "currency": "INR",
                "name": "Wastify Law Gate",
                "description": "{{ ucfirst($plan) }} Subscription",
                "handler": function (response){
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay-form').submit();
                },
                "prefill": {
                    "name": "{{ $user->name }}",
                    "email": "{{ $user->email }}"
                },
                "theme": {
                    "color": "#28a745"
                }
            };
            var rzp = new Razorpay(options);
            rzp.open();
            e.preventDefault();
        }
    </script>
    <script src="{{ asset('js/menu.js') }}"></script>
</body>
</html>
