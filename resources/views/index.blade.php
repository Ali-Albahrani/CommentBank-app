<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <title>Comment Bank</title>
</head>
<body>
    <div class="grid-container">

        <div class="logo">
            <a href="{{ url('/index') }}">
                    <img src="{{asset('img\logo.png')}}" alt="logo">
                </a>
            </div>
        <div class="title">
            <h1>Comment Bank</h1>
        </div>
        <div class="ws2">
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
        </div>


        <div class="ws3"></div>

        <div class="links">
            <li>
                <ul><a href="{{ url('/comments') }}"">View Comments</a></ul>
                <ul><a href="{{ url('/comment-bank') }}">Add/Edit/Delete/Validate Comments (Admin view)</a></ul>
            </li>
        </div>
        <div class="ws4"></div>

</body>
</html>