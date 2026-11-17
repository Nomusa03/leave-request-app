
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Leave Request</title>

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
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Edit Leave Request</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('leave-requests.update', $leaveRequest) }}">
        @csrf
        @method('PUT')

        <label for="leave_type">Leave Type</label>
        <select name="leave_type" id="leave_type" required>
            @foreach (['Annual Leave', 'Sick Leave', 'Family Responsibility Leave', 'Unpaid Leave'] as $type)
                <option value="{{ $type }}"
                    {{ old('leave_type', $leaveRequest->leave_type) == $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach
        </select>

        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" id="start_date"
            value="{{ old('start_date', $leaveRequest->start_date->format('Y-m-d')) }}" required>

        <label for="end_date">End Date</label>
        <input type="date" name="end_date" id="end_date"
            value="{{ old('end_date', $leaveRequest->end_date->format('Y-m-d')) }}" required>

        <label for="reason">Reason for Leave</label>
        <textarea name="reason" id="reason" rows="4" required>{{ old('reason', $leaveRequest->reason) }}</textarea>

        <button type="submit">Update Request</button>

        <a href="{{ route('leave-requests.index') }}" class="back">Cancel</a>
    </form>

</div>

</body>
</html>
