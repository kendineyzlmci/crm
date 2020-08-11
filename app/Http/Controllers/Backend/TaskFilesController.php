<?php

namespace App\Http\Controllers\Backend;

use App\Helper\ToastrHelper;
use App\TaskFiles;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TaskFilesController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $redirectUrl = 'tasks/show/' . $request->get('task_id') . '#documents';
        if ($request->hasFile('file')) {
            $request->validate([
                'name' => 'required|string|min:2|max:255'
            ]);

            $file = new TaskFiles();
            $file->name = $request->get('name');
            $this->validate(request(),
                ['file' => 'required|max:100000|mimes:png,jpg,jpeg,gif,pdf,doc,docx,xls,txt,mp4,avi,mkv,flv']);
            $path = Storage::disk('local')->put('/public/backend/files', request()->file('file'));
            $file->file = $path;
            $file->task_id = $request->get('task_id');
            $file->user_id = Auth::id();
            $file->save();

            if ($file) {
                toastr()->success('İşlem Başarılı.');

                return redirect($redirectUrl);
            }

            toastr()->error('İşlem Yapılırken Bir Sorun Oluştu!');

            return redirect($redirectUrl);

        } else {
            toastr()->error('Lütfen Bir Dosya Seçin!');

            return redirect($redirectUrl);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $fileInfo = TaskFiles::where('id', $id)->first();
        $destroy = TaskFiles::destroy($id);
        if($destroy){
            toastr()->success('Silme İşlemi Başarıyla Gerçekleşti!');
            return redirect('tasks/show/' . $fileInfo->task_id . '#documents');
        }else{
            toastr()->error('Silme İşlemi Yapılırken Bir Sorun Oluştu!');
            return redirect('tasks/show/' . $fileInfo->task_id . '#documents');
        }
    }
}
