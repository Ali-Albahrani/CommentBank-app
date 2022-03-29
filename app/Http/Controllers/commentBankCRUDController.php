<?php

namespace App\Http\Controllers;

use App\Models\Comments;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class commentBankCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comments::all();
        return view('comment-bank', compact('comments'));
    }

    public function fetchComments()
    {
        $comments = Comments::all();
        return response()->json([
            'comments' => $comments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment_name' => 'required',
            'email' => 'required',
            'author' => 'required',
            'effect' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => 'we ran into a problem' //$validator->messages()
            ]);
        } else {
            $comments = new Comments;
            $comments->comment_name = $request->input('comment_name');
            $comments->email = $request->input('email');
            $comments->author = $request->input('author');
            $comments->effect = $request->input('effect');

            $comments->save();
            return response()->json([
                'status' => 200,
                'message' => 'Comment Added Successfully.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $comment = Comments::find($id);
        $comment = Comments::where('comment_id', '=', $id)->get();
        if ($comment) {
            return response()->json([
                'status' => 200,
                'comment' => $comment,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Comment Found.'
            ]);
        }
    }

    /**
     * Update an existing resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comment_name' => 'required',
            'email' => 'required',
            'author' => 'required',
            'effect' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            // $comment = Comments::find($id);
            $comment = Comments::where('comment_id', '=', $id)->get();
            if ($comment) {
                $comment->comment_name = $request->input('comment_name');
                $comment->effect = $request->input('effect');
                $comment->author = $request->input('author');
                $comment->email = $request->input('email');
                $comment->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Comment with id:' . $id . ' Updated Successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Comment Found.'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $comment = Comments::find($id);
        $comment = Comments::where('comment_id', '=', $id)->get();
        if ($comment) {
            $comment->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Comment Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Comment Found.'
            ]);
        }
    }
}
