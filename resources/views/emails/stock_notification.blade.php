<!DOCTYPE html>
<html>
<head>
    <title>Stock Discount Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #ffffff;
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .stock-list {
            width: 100%;
            border-collapse: collapse;
        }
        .stock-list th, .stock-list td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .stock-list th {
            background-color: #f2f2f2;
        }
        .stock-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .stock-change {
            font-size: 16px;
            color: #d9534f; /* Red color for negative change */
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            font-size: 12px;
            color: #777;
        }
        @media only screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }
            .stock-list th, .stock-list td {
                padding: 8px;
            }
            .stock-name {
                font-size: 16px;
            }
            .stock-change {
                font-size: 14px;
            }
        }
    </style>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Stock Discount Notification</h1>
            <p>Great opportunities to buy stocks at a discount!</p>
        </div>
        <table class="stock-list" id="stockTable">
            <thead>
                <tr>
                    <th>Symbol</th>
                    <th>Change Percent</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notifications as $notification)
                    <tr>
                        <td class="stock-name">{{ $notification['symbol'] }}</td>
                        <td class="stock-change">{{ $notification['changePercent'] }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <p>This email was sent to notify you of stocks that have dropped in price significantly. Consider buying these stocks at a discount.</p>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#stockTable').DataTable({
                "paging": false, // Disable pagination if you don't need it
                "searching": true, // Enable searching
                "ordering": true, // Enable sorting
                "info": false, // Disable info text
                "order": [[1, "desc"]] // Default sorting on the second column (Change Percent) in descending order
            });
        });
    </script>
</body>
</html>