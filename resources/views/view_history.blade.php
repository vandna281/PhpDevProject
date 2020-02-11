<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>History</title>
        <link href="/css/app2.css" rel="stylesheet">
    </head>

    <body>

            <div class="header">
                <div style='margin: 10px; text-align: left'>
                    <p>Export History</p>
                </div>
            </div>

            <div style='margin: 10px; text-align: center;'>
                <table class="student-table">
                    <tr>
                        <th>Export Date</th>
                        <th>Data</th>
                    </tr>

                    @if(  count($history) > 0 )
                    @foreach($history as $hist)
                    <tr>
                        <td>{{ $hist['export_date'] }}</td>
                        <td>{{ $hist['emailList'] }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" style="text-align: center">Oh, no data found.</td>
                    </tr>
                    @endif
                </table>
            </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        
    </body>

</html>
