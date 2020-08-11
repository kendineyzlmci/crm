<?php

namespace App\Http\Controllers\Backend;

use App\Customer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $customers = \App\Customer::paginate(10);
        return view('backend.customer.index',['customers'=>$customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('backend.customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255'
        ]);

        $customer = new Customer();
        $customer->name = $request->get('name');
        $customer->agentName = $request->get('agentName');
        $customer->address = $request->get('address');
        $customer->phone = $request->get('phone');
        $customer->email = $request->get('email');
        $customer->representative = $request->get('representative');
        $customer->created_user = Auth::id();
        $customer->customer_type = $request->get('customer_type');
        if ($request->hasFile('photo_path')) {
            $this->validate(request(), ['photo_path' => 'image|mimes:png,jpg,jpeg,gif']);
            $path = Storage::disk('local')->put('/public/backend/images', request()->file('photo_path'));
            $customer->image = $path;
        }
        $customer->save();
        if ($customer) {
            toastr()->success('İşlem Başarılı.');
            return redirect()->route('customers.show',['id'=>$customer->id]);
        } else {
            toastr()->error('İşlem Yapılırken Bir Sorun Oluştu!');
            return back();
        }
    }

    public function show($id)
    {
        $customerCtrl = Customer::where('id', $id)->count();
        if ($customerCtrl != 0) {
            $customerInfo = Customer::where('id',$id)->first();
            return view('backend.customer.show',['customerInfo'=>$customerInfo]);
        }else{
            abort(404);
        }
    }

    public function edit($id)
    {
        $customerCtrl = Customer::where('id', $id)->count();
        if ($customerCtrl != 0) {
            $customerInfo = Customer::where('id',$id)->first();
            return view('backend.customer.edit',['customerInfo'=>$customerInfo]);
        }else{
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255'
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name = $request->get('name');
        $customer->agentName = $request->get('agentName');
        $customer->address = $request->get('address');
        $customer->phone = $request->get('phone');
        $customer->email = $request->get('email');
        $customer->representative = $request->get('representative');
        $customer->customer_type = $request->get('customer_type');
        $customer->status = $request->get('status');
        if ($request->hasFile('photo_path')) {
            $this->validate(request(), ['photo_path' => 'image|mimes:png,jpg,jpeg,gif']);
            $path = Storage::disk('local')->put('/public/backend/images', request()->file('photo_path'));
            $customer->image = $path;
        }
        $customer->save();
        if ($customer) {
            toastr()->success('İşlem Başarılı.');
            return back();
        } else {
            toastr()->error('İşlem Yapılırken Bir Sorun Oluştu!');
            return back();
        }
    }

    public function destroy($id)
    {
        $destroy = Customer::destroy($id);
        if($destroy){
            toastr()->success('Silme İşlemi Başarıyla Gerçekleşti!');
            return redirect()->route('customers.list');
        }else{
            toastr()->error('Silme İşlemi Yapılırken Bir Sorun Oluştu!');
            return back();
        }
    }
}
