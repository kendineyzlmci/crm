<?php

namespace App\Http\Controllers\Backend;

use App\DomainFiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DomainFilesController extends Controller
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $redirectUrl = 'domains/show/' . $request->get('domain_id') . '#documents';
        if ($request->hasFile('file')) {
            $request->validate([
                'name' => 'required|string|min:2|max:255'
            ]);

            $file = new DomainFiles();
            $file->name = $request->get('name');
            $this->validate(request(),
                ['file' => 'required|max:100000|mimes:png,jpg,jpeg,gif,pdf,doc,docx,xls,txt,mp4,avi,mkv,flv']);
            $path = Storage::disk('local')->put('/public/backend/files', request()->file('file'));
            $file->file = $path;
            $file->domain_id = $request->get('domain_id');
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fileInfo = DomainFiles::where('id', $id)->first();
        $destroy = DomainFiles::destroy($id);
        if($destroy){
            toastr()->success('Silme İşlemi Başarıyla Gerçekleşti!');
            return redirect('domains/show/' . $fileInfo->domain_id . '#documents');
        }else{
            toastr()->error('Silme İşlemi Yapılırken Bir Sorun Oluştu!');
            return redirect('domains/show/' . $fileInfo->domain_id . '#documents');
        }
    }
}
