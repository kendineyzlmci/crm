@extends('backend.layouts.layout')
@section('headersubcontent')
    <div class="col s10 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Domain Ekle</span></h5>
    </div>
    <div class="col s2 m6 l6">
        <a href="{{ url()->previous() }}" class="ml-3 btn-floating waves-effect waves-light amber darken-4 tooltipped right" data-position="bottom" data-tooltip="Geri"><i class="material-icons left">arrow_back</i></a>
    </div>
@endsection
@section('content')
    <div class="section users-edit">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12" id="account">
                        <!-- users edit account form start -->
                        <form method="POST" action="{{ route('domains.store') }}" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col s12 m12">
                                    <div class="row">
                                        <div class="col s12 input-field">
                                            <input id="name" name="name" type="url" class=" @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                                   data-error=".first_name">
                                            <label for="name">{{ __('Domain') }}</label>
                                            @error('name')
                                            <small class="name">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col s6 input-field">
                                            <select name="customer_id" id="customer_id">
                                                <option value="0">Müşteri Yok</option>
                                                @foreach(\App\Customer::all() as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="username">{{ __('Müşteri') }}</label>
                                        </div>
                                        <div class="col s6 input-field">
                                            <select name="renewal_status" id="renewal_status">
                                                <option value="0">Yenilendi</option>
                                                <option value="1">Yenilenecek</option>
                                                <option value="2">Yenilenmeyecek</option>
                                                <option value="3">Beklemede</option>
                                                <option value="4">Görüşülüyor</option>
                                                <option value="5">Bizde Değil</option>
                                            </select>
                                            <label for="username">{{ __('Yenileme Durumu') }}</label>
                                        </div>
                                        <div class="col s3 input-field">
                                            <select name="agency" id="agency">
                                                <option value="0">Bizde</option>
                                                <option value="1">Bizde Değil</option>
                                            </select>
                                            <label for="username">{{ __('Kimde') }}</label>
                                        </div>
                                        <div class="col s3 input-field">
                                            <select name="registrar" id="registrar">
                                                <option value="0">Diğer</option>
                                                <option value="1">İsim Tescil</option>
                                                <option value="2">Natro</option>
                                                <option value="3">İhs</option>
                                                <option value="4">Metunic</option>
                                                <option value="5">Turhost</option>
                                            </select>
                                            <label for="username">{{ __('Domain Sağlayıcı') }}</label>
                                        </div>
                                        <div class="col s3 input-field">
                                            <select name="hosting" id="hosting">
                                                <option value="0">Diğer</option>
                                                <option value="1">Aysima 1</option>
                                                <option value="2">Aysima 2</option>
                                                <option value="3">Aysima 3</option>
                                                <option value="4">Turhost</option>
                                                <option value="5">Natro</option>
                                                <option value="6">İsimtescil</option>
                                                <option value="7">Bizde Değil</option>
                                            </select>
                                            <label for="username">{{ __('Hosting Sağlayıcı') }}</label>
                                        </div>
                                        <div class="col s3 input-field">
                                            <select name="ssl" id="ssl">
                                                <option value="0">Yok</option>
                                                <option value="1">Var</option>
                                            </select>
                                            <label for="username">{{ __('SSL') }}</label>
                                        </div>
                                        <div class="col s4 input-field">
                                            <input id="registered_on" name="registered_on" type="date" class=" @error('registered_on') is-invalid @enderror" value="{{ date('Y-m-d') }}"
                                                   data-error=".registered_on">
                                            <label for="registered_on">{{ __('Tescil Tarihi') }}</label>
                                            @error('registered_on')
                                            <small class="registered_on">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col s4 input-field">
                                            <input id="updated_on" name="updated_on" type="date" class=" @error('updated_on') is-invalid @enderror" value="{{ date('Y-m-d') }}"
                                                   data-error=".updated_on">
                                            <label for="updated_on">{{ __('Güncelleme Tarihi') }}</label>
                                            @error('updated_on')
                                            <small class="updated_on">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col s4 input-field">
                                            <input id="expires_on" name="expires_on" type="date" class=" @error('expires_on') is-invalid @enderror" value="{{ date('Y-m-d') }}"
                                                   data-error=".expires_on">
                                            <label for="expires_on">{{ __('Bitiş Tarihi') }}</label>
                                            @error('expires_on')
                                            <small class="expires_on">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col s2">
                                            <label>
                                                <input name="status" type="radio" value="1" checked />
                                                <span>Aktif</span>
                                            </label>
                                        </div>
                                        <div class="col s2">
                                            <label>
                                                <input name="status" type="radio" value="0"/>
                                                <span>Pasif</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 display-flex justify-content-end mt-3">
                                    <button type="submit" class="btn indigo">
                                        {{ __('Kaydet') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- users edit account form ends -->
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
@endsection