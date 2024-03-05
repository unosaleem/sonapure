<html>
<head>
    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
<table id="customers">
    @foreach($input as $key=>$row)
        <tr>
            <td>{{ucfirst($key)}}</td>
            <td>{{$row}}</td>

        </tr>
    @endforeach
    @if(isset($checked))
        <tr>
            <td>About Client</td>
            <td>{{implode(',', $checked['type'])}}</td>

        </tr>
    @endif


</table>
</body>
</html>