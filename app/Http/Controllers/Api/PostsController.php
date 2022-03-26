<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    // Create post
    public function create(Request $request){

        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->desc = $request->desc;

        //check if post has photo
        if($request->photo != ''){
            //choose a unique name for photo
            $photo = time().'.jpg';
            file_put_contents('storage/posts/'.$photo,base64_decode($request->photo));
            $post->photo = $photo;
        }
        //mistake
        $post->save();
        $post->user;
        return response()->json([
            'success' => true,
            'message' => 'posted',
            'post' => $post
        ]);
    }

    // Update post
    public function update(Request $request){
        $post = Post::find($request->id);
        // check if user is editing his own post
        // we need to check user id with post user id
        if(Auth::user()->id != $post->user_id){
            return response()->json([
                'success' => false,
                'message' => 'unauthorized access'
            ]);
        }
        $post->desc = $request->desc;
        $post->update();
        return response()->json([
            'success' => true,
            'message' => 'post edited'
        ]);
    }

        // Delete post
        public function delete(Request $request){
        
            $post = Post::find($request->id);
            
            // Check if user is editing his own post
            if(Auth::user()->id != $post->user_id){
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }

            // Check if post has photo to delete
            if($post->photo != ''){
                Storage::delete('storage/posts/'.$post->photo);
            }
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => 'post deleted'
            ]);
    
        }


        public function posts(){

            $posts = Post::orderBy('id', 'desc')->get();
            foreach($posts as $post){
                
                // Get user of posts
                $post->user;

                // Comments count
                $post['commentsCount'] = count($post->comments);

                // Likes count
                $post['likesCount'] = count($post->likes);

                // Check if users liked his own post
                $post['selfLike'] = false;
                foreach($post->likes as $like){
                    if($like->user_id == Auth::user()->id){
                        $post['selfLike'] = true;
                    }
                }

            }

            return response()->json([
                'success' => true,
                'posts' => $posts
            ]);
        }
}
