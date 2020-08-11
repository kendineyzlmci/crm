<?php

namespace App\Http\Controllers\Backend;

use App\Domain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domain = \App\Domain::paginate(10);
        return view('backend.domain.index', ['domain' => $domain]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.domain.create');
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
            'name'          => 'required|string|min:2|max:255',
            'registered_on' => 'required|date',
            'expires_on'    => 'required|date|after_or_equal:registered_on',
            'updated_on'    => 'required|date|after_or_equal:registered_on',
        ]);

        $domain = new Domain();
        $domain->name = $request->get('name');
        $domain->registered_on = date('Y-m-d', strtotime($request->get('registered_on')));
        $domain->expires_on = date('Y-m-d', strtotime($request->get('expires_on')));
        $domain->updated_on = date('Y-m-d', strtotime($request->get('updated_on')));
        $domain->user_id = Auth::id();
        $domain->customer_id = $request->get('customer_id');
        $domain->agency = $request->get('agency');
        $domain->registrar = $request->get('registrar');
        $domain->renewal_status = $request->get('renewal_status');
        $domain->hosting = $request->get('hosting');
        $domain->ssl = $request->get('ssl');
        $domain->status = $request->get('status');
        $domain->phone = "";
        $domain->email = "";
        $domain->agentName = "";
        $domain->save();
        if ($domain) {
            toastr()->success('İşlem Başarılı.');
            return redirect()->route('domains.show', ['id' => $domain->id]);
        } else {
            toastr()->error('İşlem Yapılırken Bir Sorun Oluştu!');
            return back();
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
        $domainControl = Domain::where('id',$id)->count();
        if ($domainControl != 0){
            $domainInfo = Domain::where('id',$id)->first();
            return view('backend.domain.show',['domainInfo'=>$domainInfo]);
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $domainControl = Domain::where('id',$id)->count();
        if ($domainControl != 0){
            $domainInfo = Domain::where('id',$id)->first();
            return view('backend.domain.edit',['domainInfo'=>$domainInfo]);
        }else{
            abort(404);
        }
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
            'name'          => 'required|string|min:2|max:255',
            'registered_on' => 'required|date',
            'expires_on'    => 'required|date|after_or_equal:registered_on',
            'updated_on'    => 'required|date|after_or_equal:registered_on',
        ]);

        $domain = Domain::findOrFail($id);
        $domain->name = $request->get('name');
        $domain->registered_on = date('Y-m-d', strtotime($request->get('registered_on')));
        $domain->expires_on = date('Y-m-d', strtotime($request->get('expires_on')));
        $domain->updated_on = date('Y-m-d', strtotime($request->get('updated_on')));
        $domain->customer_id = $request->get('customer_id');
        $domain->agency = $request->get('agency');
        $domain->registrar = $request->get('registrar');
        $domain->renewal_status = $request->get('renewal_status');
        $domain->hosting = $request->get('hosting');
        $domain->ssl = $request->get('ssl');
        $domain->status = $request->get('status');
        $domain->save();
        if ($domain) {
            toastr()->success('İşlem Başarılı.');
            return redirect()->route('domains.show', ['id' => $domain->id]);
        } else {
            toastr()->error('İşlem Yapılırken Bir Sorun Oluştu!');
            return back();
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
        //
    }
}
