@extends('backend.layouts.layout')
@section('headersubcontent')
    <div class="col s10 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Görevler</span></h5>
    </div>
    <div class="col s2 m6 l6">
        <a onclick="app.back()" class="ml-3 btn-floating waves-effect waves-light amber darken-4 tooltipped right"
           data-position="bottom" data-tooltip="Geri"><i class="material-icons left">arrow_back</i></a>
        <a href="{{ route('domains.create') }}" class="ml-3 btn-floating waves-effect waves-light cyan tooltipped right"
           data-position="bottom" data-tooltip="Domain Ekle"><i class="material-icons left">add</i></a>
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
                                <th>Domain</th>
                                <th class="text-center">Kimde</th>
                                <th class="text-center">Son Güncelleme</th>
                                <th class="text-center">Bitiş</th>
                                <th class="text-center">Kalan Süre</th>
                                <th class="text-center">Durum</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($domain as $key => $value)
                                <tr>
                                    <td>
                                        <a href="{{ route('domains.show',['id'=>$value['id']]) }}" class="tooltipped"
                                           data-position="bottom" data-tooltip="{{$value->name }}">
                                            {{ $value->name }}
                                        </a>
                                        @if($value->CustomerCtrl==true)
                                            <br>
                                            <span>
                                                <a target="_blank"
                                                   href="{{ route('customers.show',['id'=>$value->CustomerInfo['id']])  }}"
                                                   class="blue-grey-text tooltipped" data-position="bottom"
                                                   data-tooltip="Müşteriyi Göster" style="font-size: 0.75rem;">
                                                    {{ $value->CustomerInfo['name'] }}
                                                </a>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $value->DomainAgency }}</td>
                                    <td class="text-center">{{ $value->DomainUpdate }}</td>
                                    <td class="text-center">{{ $value->DomainExpires }}</td>
                                    <td class="text-center">{{ $value->Deadline }}</td>
                                    <td class="text-center">
                                        <span class="chip {{ $value->domainStatus['color'] }} lighten-5"><span
                                                class="{{ $value->domainStatus['color'] }}-text">{{$value->domainStatus['is_active']}}</span></span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('domains.edit',['id'=>$value['id']]) }}"
                                           class="green-text tooltipped" data-position="bottom" data-tooltip="Düzenle">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="{{ route('domains.show',['id'=>$value['id']]) }}"
                                           class="blue-text tooltipped" data-position="bottom" data-tooltip="Görüntüle">
                                            <i class="material-icons">remove_red_eye</i>
                                        </a>
                                        <a href="{{ route('domains.destroy',['id'=>$value['id']]) }}"
                                           class="red-text tooltipped" data-position="bottom" data-tooltip="Sil">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="8">{{ $domain->links() }}</td>
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