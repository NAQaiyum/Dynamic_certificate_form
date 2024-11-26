<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>CERTIFICATE</title>
    <style>
        @page {
            size: A4;
            margin: 1;
			background-color : #FAEBF0 !important
        }
        body {
            margin: 0;
            padding: 0;
        }
        .content-container {
        padding: 2cm 1cm 2cm; /* Adjust padding as needed (top, right, bottom) */
        }
        .table-size {
            width: 100%;
            height: 100%;
            background-color: #FAEBF0 !important;
        }
        .table-size td {
        	border: 1px solid #8e8b8f; /* Set the border color for table cells */
        }
        .right-align {
            text-align: right;
        }
        .flex-container {
            display: flex;
            justify-content: space-between;
        }
        .column {
            flex: 1;
            border: none;
            text-align: left;
        }
        .left {
            text-align: left;
        }
        .center {
            text-align: center;
        }
        .right {
            text-align: right;
        }
        .new {
            flex: 1;
            text-align: right;
        }
        
    </style>

    
</head>
<body>
    <div class="container">
        @yield('contents')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>