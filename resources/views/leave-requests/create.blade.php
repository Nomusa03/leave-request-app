
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Leave Request</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            color: #243b53;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 7px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button, a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .back {
            background: #64748b;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Submit Leave Request</h1>

    @if ($errors->any())
        <div class="error">
            <p>Please correct the following errors:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('leave-requests.store') }}">
        @csrf

        <label for="leave_type">Leave Type</label>
        <select name="leave_type" id="leave_type" required>
            <option value="">Select leave type</option>
            <option value="Annual Leave" {{ old('leave_type') == 'Annual Leave' ? 'selected' : '' }}>Annual Leave</option>
            <option value="Sick Leave" {{ old('leave_type') == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
            <option value="Family Responsibility Leave" {{ old('leave_type') == 'Family Responsibility Leave' ? 'selected' : '' }}>Family Responsibility Leave</option>
            <option value="Unpaid Leave" {{ old('leave_type') == 'Unpaid Leave' ? 'selected' : '' }}>Unpaid Leave</option>
        </select>

        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required>

        <label for="end_date">End Date</label>
        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required>

        <label for="reason">Reason for Leave</label>
        <textarea name="reason" id="reason" rows="4" required>{{ old('reason') }}</textarea>

        <button type="submit">Submit Request</button>

        <a href="{{ route('leave-requests.index') }}" class="back">Back</a>
    </form>

</div>

</body>
</html>
