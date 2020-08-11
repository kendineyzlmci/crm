<?php

namespace App\Http\Controllers\Backend;

use App\TaskComments;
use App\TaskCommentsLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'comments' => 'required|string|min:2',
            'task_id'  => 'required|integer|min:1'
        ]);

        $comment = new TaskComments();
        $comment->comment = $request->get('comments');
        $comment->user_id = Auth::id();
        $comment->task_id = $request->get('task_id');
        $comment->status = 1;
        $comment->save();

        if($comment){
            toastr()->success('İşlem Başarılı!');
            return redirect('tasks/show/' . $request->get('task_id') . '#comments');
        }else{
            toastr()->error('İşlem Yapılırken Bir Sorun Oluştu!');
            return redirect('tasks/show/' . $request->get('task_id') . '#comments');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comments' => 'required|string|min:2',
            'task_id'  => 'required|integer|min:1'
        ]);

        $comment = TaskComments::findOrFail($id);
        $comment->comment = $request->get('comments');
        $comment->save();

        if($comment){
            toastr()->success('İşlem Başarılı!');
            return redirect('tasks/show/' . $request->get('task_id') . '#comments');
        }else{
            toastr()->error('İşlem Yapılırken Bir Sorun Oluştu!');
            return redirect('tasks/show/' . $request->get('task_id') . '#comments');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commentInfo = TaskComments::where('id', $id)->first();
        $destroy = TaskComments::destroy($id);
        if($destroy){
            toastr()->success('Silme İşlemi Başarıyla Gerçekleşti!');
            return redirect('tasks/show/' . $commentInfo->task_id . '#comments');
        }else{
            toastr()->error('Silme İşlemi Yapılırken Bir Sorun Oluştu!');
            return redirect('tasks/show/' . $commentInfo->task_id . '#comments');
        }
    }

    public function like($id)
    {
        $comment_control = TaskComments::where('id', $id)->first();
        $like_control = TaskCommentsLike::where('comment_id', $id)->where('user_id', Auth::id())->first();
        if ($like_control) {
            $unlike = TaskCommentsLike::destroy($like_control->id);
            if($unlike){
                toastr()->success('İşlem Başarılı!');
                return redirect('tasks/show/' . $comment_control->task_id . '#comments');
            }else{
                toastr()->error('İşlem Yapılırken Bir Sorun Oluştu!');
                return redirect('tasks/show/' . $comment_control->task_id . '#comments');
            }
        } else {
            $like = new TaskCommentsLike();
            $like->comment_id = $id;
            $like->user_id = Auth::id();
            $like->save();
            if($like){
                toastr()->success('İşlem Başarılı!');
                return redirect('tasks/show/' . $comment_control->task_id . '#comments');
            }else{
                toastr()->error('İşlem Yapılırken Bir Sorun Oluştu!');
                return redirect('tasks/show/' . $comment_control->task_id . '#comments');
            }
        }
    }
}
