import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

require('./bootstrap');

$(document).ready(function ($) {

    fetchComments(); // Get the table from the dB to start 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function fetchComments() {
        // ajax 
        $.ajax({
            type: "GET",
            url: "fetch-comments",
            dataType: 'json',
            success: function (res) {
                // console.log(res); 
                $('tbody').html("");
                $.each(res.comments, function (key, item) {
                    $('tbody').append('<tr>\
                                <td><input type = "checkbox" name = "effect" id = "effect' +
                                item.id + '"value = "' + item.effect + '" /></td>\
                                <td>' + item.id + '</td>\
                                <td>' + item.type + '</td>\
                                <td>' + item.comment_name + '</td>\
                                <td>' + item.author + '</td>\
                                <td>' + item.email + '</td>\
                                <td>' + item.effect + '</td>\
                                <td>' + item.validated + '</td>\
                                <td><button type = "button" data-id ="' + item.id + '"class = "btn btn-primary edit btn-sm">Edit</button>\
                                <button type = "button" data-id = "' + item.id + '"class = "btn btn-danger delete btn-sm"> Delete </button></td > \
                                </tr>');
                });
            },
            complete: function () {
                isChecked();
            }
        });
    }

    $('#addNewComment').click(function (event) {
        // evt.preventDefault();
        $('#addEditCommentForm').trigger("reset");
        $('#ajaxCommentModel').html("Add Comment");
        $('#btn-add').show();
        $('#btn-save').hide();
        $('#ajax-comment-model').modal('show');
        // $('#message').fadeOut(4000);

    });

    $('body').on('click', '#btn-add', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        var type = $("#type").val();
        var comment_name = $("#comment_name").val();
        var author = $("#author").val();
        var effect = $("#effect").val();
        var email = $("#email").val();
        var validated = $("#validated").val();
        $("#btn-add").html('Please Wait...');
        $("#btn-add").attr("disabled", true);
        // ajax 
        $.ajax({
            type: "POST",
            url: "save-comment",
            data: {
                id: id,
                type: type,
                comment_name: comment_name,
                author: author,
                email: email,
                validated: validated,
                effect: effect
            },
            dataType: 'json',
            success: function (res) {
                console.log(res);
                if (res.status == 400) {
                    $('#msgList').html("");
                    $('#msgList').addClass('alert alert-danger');
                    $.each(res.errors, function (key, err_value) {
                        $('#msgList').append('<li>' + err_value + '</li>');
                    });
                    $('#btn-save').text('Save changes');
                } else {
                    $('#message').html("");
                    $('#message').addClass('alert alert-success');
                    $('#message').text(res.message);
                    fetchComments();
                }
            },
            complete: function () {
                $("#btn-add").html('Save');
                $("#btn-add").attr("disabled", false);
                $("#btn-add").hide();
                $('#ajax-comment-model').modal('hide');
                $('#message').fadeOut(4000);
            }
        });
    });
    $('body').on('click', '.edit', function (evt) {
        evt.preventDefault();
        var id = $(this).data('id');
        // ajax 
        $.ajax({
            type: "GET",
            url: "edit-comment/" + id,
            dataType: 'json',
            success: function (res) {
                console.dir(res);
                $('#ajaxCommentModel').html("Edit Comment");
                $('#btn-add').hide();
                $('#id').val(id);
                $('#btn-save').show();
                $('#ajax-comment-model').modal('show');
                if (res.status == 404) {
                    $('#msgList').html("");
                    $('#msgList').addClass('alert alert-danger');
                    $('#msgList').text(res.message);
                } else {
                    // console.log(res.comment);
                    // console.log(typeof (res.comment));
                    $('#email').val(res.comment.email);
                    $('#comment_name').val(res.comment.comment_name);
                    $('#author').val(res.comment.author);
                    $('#effect').val(res.comment.effect);
                    $('#type').val(res.comment.type);
                    $('#validated').val(res.comment.validated);
                }
            }
        });
    });
    $('body').on('click', '.delete', function (evt) {
        evt.preventDefault();
        if (confirm("Delete Comment?") == true) {
            var id = $(this).data('id');
            // ajax 
            $.ajax({
                type: "DELETE",
                url: "delete-comment/" + id,
                dataType: 'json',
                success: function (res) {
                    // console.log(res); 
                    if (res.status == 404) {
                        $('#message').addClass('alert alert-danger');
                        $('#message').text(res.message);
                    } else {
                        $('#message').html("");
                        $('#message').addClass('alert alert-success');
                        $('#message').text(res.message);
                    }
                    fetchComments();
                }
            });
        }
    });
    $('body').on('click', '#btn-save', function (event) {
        event.preventDefault();
        var id = $("#id").val();
        var type = $("#type").val();
        var comment_name = $("#comment_name").val();
        var author = $("#author").val();
        var effect = $("#effect").val();
        var email = $("#email").val();
        var validated = $("#validated").val();
        // alert("id="+id+" title = " + title); 
        $("#btn-save").html('Please Wait...');
        $("#btn-save").attr("disabled", true);
        // ajax 
        $.ajax({
            type: "PUT",
            url: "update-comment/" + id,
            data: {
                id: id,
                type: type,
                comment_name: comment_name,
                author: author,
                email: email,
                effect: effect,
                validated: validated,
            },
            dataType: 'json',
            success: function (res) {
                console.log(res);
                if (res.status == 400) {
                    $('#msgList').html("");
                    $('#msgList').addClass('alert alert-danger');
                    $.each(res.errors, function (key, err_value) {
                        $('#msgList').append('<li>' + err_value + '</li>');
                    });
                    $('#btn-save').text('Save changes');
                } else {
                    $('#message').html("");
                    $('#message').addClass('alert alert-success');
                    $('#message').text(res.message);
                    fetchComments();
                }
            },
            complete: function () {
                $("#btn-save").html('Save changes');
                $("#btn-save").attr("disabled", false);
                $('#ajax-comment-model').modal('hide');
                $('#message').fadeOut(4000);
            }
        });
    });
    $("#btnGet").click(function () {
        var message = "";
        //Loop through all checked CheckBoxes in GridView. 
        $("#Table1 input[type=checkbox]:checked").each(function () {
            var row = $(this).closest("tr")[0];
            // message += row.cells[2].innerHTML; 
            message += " " + row.cells[3].innerHTML;
            // message += " " + row.cells[4].innerHTML; 
            // message += "\n-----------------------\n";
        });

        //Display selected Row data in Alert Box. 
        $("#messageList").html(message);
        return false;
    });

    $("#copy").click(function () {
        $("#messageList").select();
        document.execCommand("copy");
        alert("Copied On clipboard");
    });

    function isChecked() {
        $("#Table1 input[type=checkbox]").each(function () {
            if ($(this).val() == 1) {
                $(this).prop("checked", true);
            } else {
                $(this).prop("checked", false);
            }
        });
    }
});