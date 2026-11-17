
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Leave Requests</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            color: #243b53;
        }

        a, button {
            background: #2563eb;
            color: white;
            padding: 9px 14px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #eef2ff;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            margin: 15px 0;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .logout {
            background: #dc2626;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>My Leave Requests</h1>

    <p>Welcome, {{ Auth::user()->name }}!</p>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('leave-requests.create') }}">+ Submit Leave Request</a>

    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit" class="logout">Logout</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Leave Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($leaveRequests as $leaveRequest)
                <tr>
                    <td>{{ $leaveRequest->leave_type }}</td>
                    <td>{{ $leaveRequest->start_date->format('d M Y') }}</td>
                    <td>{{ $leaveRequest->end_date->format('d M Y') }}</td>
                    <td>{{ $leaveRequest->status }}</td>
                    <td>
                      <div class="actions">
    <a href="{{ route('leave-requests.show', $leaveRequest) }}">View</a>

    @if ($leaveRequest->status === 'Pending')
        <a href="{{ route('leave-requests.edit', $leaveRequest) }}">Edit</a>

        <form method="POST" action="{{ route('leave-requests.destroy', $leaveRequest) }}"
              onsubmit="return confirm('Are you sure you want to delete this leave request?');">
            @csrf
            @method('DELETE')

            <button type="submit" style="background: #dc2626;">Delete</button>
        </form>
    @endif
</div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">You have not submitted any leave requests yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</body>
</html>
