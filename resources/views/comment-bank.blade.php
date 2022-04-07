<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Comments Bank</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{asset('js/app.js')}}"></script> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>

<body>
    @extends('base')
    @section('main')
    <div class="container mt-2">

        <div class="row">
            <div class="col-md-12 card-header text-center font-weight-bold">
            <a href="{{ url('/index') }}">
                <img src="{{asset('img\logo.png')}}" alt="logo">
            </a>
                <h2>Comments</h2>
            </div>

            <div id="message"></div>

            <div class="col-md-12 mt-1 mb-2">
                <button type="button" id="addNewComment" class="btn btn-success">Add</button>
            </div>

            <div class="col-md-12">
                <table id="Table1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">#</th>
                            <th scope="col">Type</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Comment Author</th>
                            <th scope="col">Email</th>
                            <th scope="col">Effect</th>
                            <th scope="col">Validated</th>
                            <th scope="col">Action</th>
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


    <!-- boostrap model -->
    <div class="modal fade" id="ajax-comment-model" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxCommentModel"></h4>
                </div>

                <div class="modal-body">
                    <ul id="msgList"></ul>
                    <form action="javascript:void(0)" id="addEditCommentForm" name="addEditCommentForm" class="form-horizontal" method="POST">
                        <input type="hidden" name="id" id="id">
                        
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Type</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="type" name="type" placeholder="Enter Comment Type" value="" maxlength="50" required="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Comment</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="comment_name" name="comment_name" placeholder="Enter Comment" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Author</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="author" name="author" placeholder="Enter author Name" value="" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="" required="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-4 control-label">Effect</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="effect" name="effect" placeholder="Enter Comment Effect" value="" required="">
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Validated</label>
                            <div class="col-sm-12">
                                <input type="boolean" class="form-control" id="validated" name="validated" placeholder=" 1 = validated | 0 = non-validated" value="" required="">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-add" value="addNewComment">Save</button>
                            <button type="submit" class="btn btn-primary" id="btn-save" value="UpdateComment">Save changes</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- end bootstrap model -->
    @endsection

</body>

</html>