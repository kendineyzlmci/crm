@extends('backend.layouts.layout')
@section('headersubcontent')
    <div class="col s10 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Müşteriler</span></h5>
    </div>
    <div class="col s2 m6 l6">
        <a onclick="app.back()" class="ml-3 btn-floating waves-effect waves-light amber darken-4 tooltipped right" data-position="bottom" data-tooltip="Geri"><i class="material-icons left">arrow_back</i></a>
        <a href="{{ route('customers.create') }}" class="ml-3 btn-floating waves-effect waves-light cyan tooltipped right" data-position="bottom" data-tooltip="Görev Ekle"><i class="material-icons left">add</i></a>
    </div>
@endsection
@section('content')
    <section class="users-list-wrapper section">
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <!-- datatable start -->
                    <div class="responsive-table">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>Müşteri Adı</th>
                                    <th class="text-center">Temsilci</th>
                                    <th class="text-center">Ekleme</th>
                                    <th class="text-center">Güncelleme</th>
                                    <th class="text-center">Tip</th>
                                    <th class="text-center">Durum</th>
                                    <th class="text-center">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $key => $value)
                                <tr>
                                    <td>
                                        <a href="{{ route('customers.show',['id'=>$value['id']]) }}">
                                            <img src="{{ $value->image }}" class="avatar-status"> {{ $value->name }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('users.detail',['id'=>$value->CustomerUserInfo['id']]) }}" target="_blank"  class="tooltipped" data-position="bottom" data-tooltip="{{ $value->CustomerUserInfo['fullName'] }}">
                                            <img src="{{ $value->CustomerUserInfo['image'] }}" class="avatar-status">
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $value->CustomerCreatedAtDate }}</td>
                                    <td class="text-center">{{ $value->CustomerUpdatedAtDate }}</td>
                                    <td class="text-center">
                                        <span class="chip {{ $value->CustomerTypeInfo['color'] }} lighten-5"><span class="{{ $value->CustomerTypeInfo['color'] }}-text">{{$value->CustomerTypeInfo['is_active']}}</span></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="chip {{ $value->CustomerStatus['color'] }} lighten-5"><span class="{{ $value->CustomerStatus['color'] }}-text">{{$value->CustomerStatus['is_active']}}</span></span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('customers.edit',['id'=>$value['id']]) }}" class="green-text tooltipped" data-position="bottom" data-tooltip="Düzenle">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="{{ route('customers.show',['id'=>$value['id']]) }}" class="blue-text tooltipped" data-position="bottom" data-tooltip="Görüntüle">
                                            <i class="material-icons">remove_red_eye</i>
                                        </a>
                                        <a href="{{ route('customers.destroy',['id'=>$value['id']]) }}" class="red-text tooltipped" data-position="bottom" data-tooltip="Sil">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="8">{{ $customers->links() }}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- datatable ends -->
                </div>
            </div>
        </div>
    </section>
@endsection