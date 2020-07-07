<?php

namespace App\Http\Controllers\Advance;

use App\Model\Post;
use App\Model\Notification;
use Illuminate\Http\Request;
use App\Events\CommentNotification;
use App\Http\Controllers\Controller;

class PusherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id= '')
    {
        if(isset($id) && ! empty($id)){
            Notification::find($id)->update(['seen' => 1]);
        }
        $posts = Post::where('user_id', '!=', auth()->id())->with('comments')->get();
        return view('advance.pusher', compact('posts'));
    }

    public function addComment($post_id, Request $request)
    {
        //return $request;
        $post = Post::find($post_id);
        if(! $post)
            return redirect()->route('home')->with('error', 'No data found');

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment
        ]);
        $data=[];
        $data['user_img'] = auth()->user()->getAvatar();
        $data['title'] = 'تم إضافة تعليق جديد';
        $data['content'] = "قام " . auth()->user()->name . " بإضافة تعليق على " . $post->title;
        $data['user_id'] = $post->user_id;
        $data['name'] = auth()->user()->name;
        $data['post_id'] = $post->id;
        $data['url'] = route('home');

        $notification = Notification::create($data);
        $data['created_at'] = $notification->created_at;
        $data['url'] = route('pusher', $notification->id);
        $data['comment'] = $comment->comment;

        // return $data;

        event(new CommentNotification($data));
        if($request->ajax())
            return response()->json(['data' => $data, 'status' => true, 'msg'=>""]);

        return redirect()->route('pusher')->with('success', 'comment add success');
    }// end addComment

}// end controller
