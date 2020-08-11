<?php

namespace App\Http\Controllers\Backend;

use App\Task;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $tasks = \App\Task::paginate(10);
        return view('backend.task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('backend.task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|min:2|max:255',
            'description' => 'required|string|min:2',
            'start_date'  => 'required|date',
            'finish_date' => 'required|date|after_or_equal:start_date',
        ]);

        $task = new Task();
        $task->title = $request->get('title');
        $task->description = $request->get('description');
        $task->start_date = date('Y-m-d', strtotime($request->get('start_date')));
        $task->finish_date = date('Y-m-d', strtotime($request->get('finish_date')));
        $task->task_user = $request->get('task_user');
        $task->priority = $request->get('priority');
        $task->customer_id = $request->get('customer_id');
        $task->status = $request->get('status');
        $task->created_user = Auth::id();
        $task->save();

        if ($task) {
            toastr()->success('İşlem Başarılı.');
            return redirect()->route('tasks.show',['id'=>$task->id]);
        } else {
            toastr()->error('İşlem Yapılırken Bir Sorun Oluştu!');
            return back();
        }
    }

    /**m
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id)
    {
        $taskCtrl = Task::where('id', $id)->count();
        if ($taskCtrl != 0) {
            $taskInfo = Task::where('id', $id)->first();
            return view('backend.task.show', ['taskInfo' => $taskInfo]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $taskCtrl = Task::where('id', $id)->count();
        if ($taskCtrl != 0) {
            $taskInfo = Task::where('id', $id)->first();
            return view('backend.task.edit', ['taskInfo' => $taskInfo]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|min:2|max:255',
            'description' => 'required|string|min:2',
            'start_date'  => 'required|date',
            'finish_date' => 'required|date|after_or_equal:start_date'
        ]);

        $task = Task::findOrFail($id);
        $task->title = $request->get('title');
        $task->description = $request->get('description');
        $task->start_date = date('Y-m-d', strtotime($request->get('start_date')));
        $task->finish_date = date('Y-m-d', strtotime($request->get('finish_date')));
        $task->task_user = $request->get('task_user');
        $task->priority = $request->get('priority');
        $task->customer_id = $request->get('customer_id');
        $task->status = $request->get('status');
        $task->save();
        if ($task) {
            toastr()->success('İşlem Başarılı.');
            return back();
        } else {
            toastr()->error('İşlem Yapılırken Bir Sorun Oluştu!');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $destroy = Task::destroy($id);
        if($destroy){
            toastr()->success('Silme İşlemi Başarıyla Gerçekleşti!');
            return redirect()->route('tasks.list');
        }else{
            toastr()->error('Silme İşlemi Yapılırken Bir Sorun Oluştu!');
            return back();
        }
    }
}
