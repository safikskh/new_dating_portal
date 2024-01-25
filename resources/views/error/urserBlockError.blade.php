<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 Dating Portalin</title>
    <link href="https://fonts.googleapis.com/css?family=Muli:400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Passion+One" rel="stylesheet">


    <link href="{{ asset('error/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('error/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <div id="notfound">
        <div class="notfound-bg"></div>
        <div class="notfound">
            <div class="notfound-404">
                {{-- <h1>404</h1> --}}
            </div>
            <h2>Oops! User Not Found</h2>

            <h3>This user has been blocked by you! </br> Or </br> From user!</h3>
            
            <a href="{{ route('home') }}">Back To Homepage</a>
        </div>
    </div>

</body>

</html>
