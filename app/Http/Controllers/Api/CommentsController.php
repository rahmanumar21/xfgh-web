<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Like;  
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    // Create comment
    public function create(Request $request){

        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->id;
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json([
            'success' => true,
            'message' => 'comment added'
        ]);
    
    }

    // Update comment
    public function update(Request $request){
        
        $comment = Comment::find($request->id);

        // Check if user is editing his own comment
        if($comment->id != Auth::user()->id){
            return response()->json([
                'success' => false,
                'message' => 'unauthorize access'
            ]);
        }

        $comment->comment = $request->comment;
        $comment->update();

        return response()->json([
            'success' => true,
            'message' => 'comment edited'
        ]);
    }

    // Delete comment
    public function delete(Request $request){
        
        $comment = Comment::find($request->id);

        // Check if user is editing his own comment
        if($comment->id != Auth::user()->id){
            return response()->json([
                'success' => false,
                'message' => 'unauthorize access'
            ]);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'comment deleted'
        ]);
    }

    // Show comments
    public function comments(Request $request){
        
        $comments = Comment::where('post_id', $request->id)->get();

        // Show user of each comments
        foreach($comments as $comment){
            $comment->user;
        }

        return response()->json([
            'success' => true,
            'comments' => $comments
        ]);

    }
}
