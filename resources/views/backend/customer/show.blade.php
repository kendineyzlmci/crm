@extends('backend.layouts.layout')
@section('headersubcontent')
    <div class="col s10 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Müşteri Profili</span></h5>
    </div>
    <div class="col s2 m6 l6">
        <a href="{{ url()->previous() }}" class="ml-3 btn-floating waves-effect waves-light amber darken-4 tooltipped right" data-position="bottom" data-tooltip="Geri"><i class="material-icons left">arrow_back</i></a>
        <a href="{{ route('customers.edit',['id'=>$customerInfo->id]) }}" class="ml-3 btn-floating waves-effect waves-light cyan tooltipped right" data-position="bottom" data-tooltip="Düzenle"><i class="material-icons left">edit</i></a>
    </div>
@endsection
@section('content')
    <div class="section users-view">
        <!-- users view media object start -->
        <div class="card-panel">
            <div class="row">
                <div class="col s12 m7">
                    <div class="display-flex media">
                        <a href="#" class="avatar">
                            <img src="{{ $customerInfo->image }}" alt="users view avatar" class="z-depth-4 circle"
                                 height="64" width="64">
                        </a>
                        <div class="media-body">
                            <h6 class="media-heading">
                                <span class="users-view-name">{{ $customerInfo->name }} </span>
                            </h6>
                            <span class="users-view-id">
                                Son Güncelleme : {{ $customerInfo->CustomerUpdatedAt }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-1">
                    <a href="tel:{{ $customerInfo->phone }}" class="btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange tooltipped right" data-position="bottom" data-tooltip="Ara"><i class="material-icons left">phone</i></a>
                    <a href="mailto:{{ $customerInfo->email }}" class="btn-floating waves-effect waves-light gradient-45deg-green-teal tooltipped right" data-position="bottom" data-tooltip="Eposta"><i class="material-icons left">message</i></a>
                </div>
            </div>
        </div>
        <!-- users view media object ends -->
        <!-- users view card data start -->
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m12">
                        <h6 class="mb-2 mt-2"><i class="material-icons">info</i> Müşteri Detayları</h6>
                    </div>
                    <div class="col s12 m6">
                        <table class="striped">
                            <tbody>
                                <tr>
                                    <td>Firma Yetkilisi:</td>
                                    <td class="users-view-username">{{ $customerInfo->agentName }}</td>
                                </tr>
                                <tr>
                                    <td>Adres:</td>
                                    <td class="users-view-username">{{ $customerInfo->address }}</td>
                                </tr>
                                <tr>
                                    <td>Telefon:</td>
                                    <td class="users-view-username">{{ $customerInfo->phone }}</td>
                                </tr>
                                <tr>
                                    <td>E-Posta:</td>
                                    <td class="users-view-username">{{ $customerInfo->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col s12 m6">
                        <table class="striped">
                            <tbody>
                                <tr>
                                    <td>Müşteri Tipi:</td>
                                    <td class="users-view-name">
                                        <span class="chip {{ $customerInfo->CustomerTypeInfo['color'] }} lighten-5"><span class="{{ $customerInfo->CustomerTypeInfo['color'] }}-text">{{$customerInfo->CustomerTypeInfo['is_active']}}</span></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Durum:</td>
                                    <td class="users-view-email">
                                        <span class="chip {{ $customerInfo->CustomerStatus['color'] }} lighten-5"><span class="{{ $customerInfo->CustomerStatus['color'] }}-text">{{$customerInfo->CustomerStatus['is_active']}}</span></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Oluşturma:</td>
                                    <td class="users-view-username">{{ $customerInfo->CustomerCreatedAt }}</td>
                                </tr>
                                <tr>
                                    <td>Güncelleme:</td>
                                    <td class="users-view-latest-activity">{{ $customerInfo->CustomerUpdatedAt }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m12">
                        <h6 class="mb-2 mt-2"><i class="material-icons">info</i> Görevler</h6>
                    </div>
                    <div class="col s12 m12">
                        <table id="users-list-datatable" class="table">
                            <thead>
                            <tr>
                                <th>Başlık</th>
                                <th>Ekleme</th>
                                <th>Güncelleme</th>
                                <th>Öncelik</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Task::where('customer_id',$customerInfo->id)->get() as $key => $value)
                                <tr>
                                    <td>
                                        <a href="{{ route('tasks.show',['id'=>$value['id']]) }}" target="_blank">
                                            {{ $value->title }}
                                        </a>
                                    </td>
                                    <td>{{ $value->TaskCreatedAt }}</td>
                                    <td>{{ $value->TaskUpdatedAt }}</td>
                                    <td>
                                        <span class="chip {{ $value->taskPriority['color'] }} lighten-5"><span class="{{ $value->taskPriority['color'] }}-text">{{$value->taskPriority['is_active']}}</span></span>
                                    </td>
                                    <td>
                                        <span class="chip {{ $value->taskStatus['color'] }} lighten-5"><span class="{{ $value->taskStatus['color'] }}-text">{{$value->taskStatus['is_active']}}</span></span>
                                    </td>
                                    <td>
                                        <a href="{{ route('tasks.edit',['id'=>$value['id']]) }}" class="green-text tooltipped" data-position="bottom" data-tooltip="Düzenle" target="_blank">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="{{ route('tasks.show',['id'=>$value['id']]) }}" class="blue-text tooltipped" data-position="bottom" data-tooltip="Görüntüle" target="_blank">
                                            <i class="material-icons">remove_red_eye</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- users view card data ends -->
    </div>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/pages/page-users.css') }}">
@endsection
@section('js')
    <script src="{{ asset('backend/js/scripts/page-users.js') }}"></script>
@endsection