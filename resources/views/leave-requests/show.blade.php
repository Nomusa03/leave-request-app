
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Details</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            color: #243b53;
        }

        .detail {
            padding: 12px 0;
            border-bottom: 1px solid #ddd;
        }

        .label {
            font-weight: bold;
            color: #475569;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            background: #64748b;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .edit {
            background: #2563eb;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Leave Request Details</h1>

    <div class="detail">
        <span class="label">Leave Type:</span>
        {{ $leaveRequest->leave_type }}
    </div>

    <div class="detail">
        <span class="label">Start Date:</span>
        {{ $leaveRequest->start_date->format('d M Y') }}
    </div>

    <div class="detail">
        <span class="label">End Date:</span>
        {{ $leaveRequest->end_date->format('d M Y') }}
    </div>

    <div class="detail">
        <span class="label">Reason:</span>
        {{ $leaveRequest->reason }}
    </div>

    <div class="detail">
        <span class="label">Status:</span>
        {{ $leaveRequest->status }}
    </div>

    <div class="detail">
        <span class="label">Submitted:</span>
        {{ $leaveRequest->created_at->format('d M Y, H:i') }}
    </div>

    @if ($leaveRequest->status === 'Pending')
        <a href="{{ route('leave-requests.edit', $leaveRequest) }}" class="edit">Edit Request</a>
    @endif

    <a href="{{ route('leave-requests.index') }}">Back to My Requests</a>

</div>

</body>
</html>
