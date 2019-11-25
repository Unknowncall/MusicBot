<!DOCTYPE html>
<html>
<head>
    <title>Music Bot</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/09e46c79f6.js"></script>
    <style>
        th{
            text-decoration: underline;
        }
        .directionsContainer{
            width:380px;
            height:600px;
            overflow-y: auto;
            float:left;
            background-color: white;
            margin-bottom: 20px;
        }

        #map{
            position:relative;
            width:calc(100% - 380px);
            height:600px;
            float:left;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="index.php"><i class="fas fa-music" style="padding-right:5px;"></i>Music Database</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=request">Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=queue">Queue</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>