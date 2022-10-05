<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <style>
    .card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 300px;
    margin: auto;
    text-align: center;
    font-family: arial;
    }

    .title {
    color: grey;
    font-size: 18px;
    }

    button {
    border: none;
    outline: 0;
    display: inline-block;
    padding: 8px;
    color: white;
    background-color: #000;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
    }

    a {
    text-decoration: none;
    font-size: 22px;
    color: black;
    }

    button:hover, a:hover {
    opacity: 0.7;
    }
    </style>

</head>
<body>
    <div class="container">
        <button class="btn btn-primary"><a href="http://127.0.0.1:8000/use_api/1">Previous</a></button>
        <button class="btn btn-primary"><a href="http://127.0.0.1:8000/use_api/2">Next</a></button>
        <div class="row">
            @foreach($data as $val)
            <div class="col-lg-4">

                <div class="card">
                <img src="{{$val['avatar']}}" alt="John" style="width:100%">
                <h1>{{$val['first_name']}} {{$val['last_name']}}</h1>
                <p class="title">{{$val['email']}}</p>
                <div style="margin: 24px 0;">
                    <a href="#"><i class="fa fa-dribbble"></i></a> 
                    <a href="#"><i class="fa fa-twitter"></i></a>  
                    <a href="#"><i class="fa fa-linkedin"></i></a>  
                    <a href="#"><i class="fa fa-facebook"></i></a> 
                </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</body>
</html>