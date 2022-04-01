<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<body>
    @extends('view')
    @section('reader')
    <div class="container mt-2">

        <div class="row">
            <div class="col-md-12 card-header text-center font-weight-bold">
            <a href="{{ url('/index') }}">
                <img src="{{asset('img\logo.png')}}" alt="logo">
            </a>
                <h2>Comments</h2>
            </div>

            <div class="col-md-12">
                <table id="Table2" class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">#</th>
                            <th scope="col">Type</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Comment Author</th>
                            <th scope="col">Email</th>
                            <th scope="col">Effect</th>
                        </tr>
                    </thead>
                    <tbody>
           
                    </tbody>
            
                </table>

                <input id="btnGet" type="button" value="Get Selected" />

            </div>
        </div>

        <div>
            <textarea id="messageList" rows="10" cols="100">Selection</textarea>
            <button type="button" id="copy">Copy</button>
        </div>
    </div>
    <script src="{{mix('js/commentView.js')}}"></script>
    @endsection
</body>
</html>
