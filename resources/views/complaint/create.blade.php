<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Overflowing Bin | Wastify</title>
    <link rel="stylesheet" type="text/css" href="/css/resident_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 120px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: inherit;
        }
        .btn-submit {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            font-weight: 600;
        }
        .btn-submit:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    @include('resident_header')

    <div class="form-container">
        <h2><i class="fas fa-exclamation-triangle"></i> Report Overflowing Bin</h2>
        <p>Spotted a full public bin? Tell us the location so our team can clear it.</p>

        <form action="{{ route('complaint.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Street / Area Name</label>
                <input type="text" name="location" placeholder="e.g. Market Street, near PG block 4" required>
            </div>
            <div class="form-group">
                <label>Describe the Issue</label>
                <textarea name="description" rows="4" placeholder="e.g. The green bin is completely full and garbage is spilling out." required></textarea>
            </div>
            <button type="submit" class="btn-submit">Submit Report</button>
        </form>
    </div>

    <script src="{{ asset('js/menu.js') }}"></script>
</body>
</html>
