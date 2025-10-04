<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
    public function readBlog( Request $reque ) {
        return response()->json( Post::all() );
    }

    public function createBlog( Request $request ) {
        $id = Auth::id();
        $data = $request->validate( [
            'title'   => 'required',
            'content' => 'required',
        ] );

        Post::create( [
            'title'   => $data['title'],
            'content' => $data['content'],
            'user_id' => $id,
        ] );

        return response()->json( ['message' => 'Post Created Successfully'] );
    }

    public function updateBlog( Request $request, $id ) {
        $post = Post::find( $id );

        $data = $request->validate( [
            'title'   => 'required',
            'content' => 'required',
        ] );

        $post->update( [
            'title'   => $data['title'],
            'content' => $data['content'],
        ] );

        return response()->json( ['message' => 'Post Updated Successfully'] );
    }

    public function deleteBlog( $id ) {
        $post = Post::find( $id );
        $post->delete();

        return response()->json( ['message' => 'Post Deleted Successfully'] );
    }
}
