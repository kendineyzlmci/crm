@extends('backend.layouts.layout')
@section('headersubcontent')
    <div class="col s10 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Müşteri Ekle</span></h5>
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
                        <form method="POST" action="{{ route('customers.store') }}" enctype="multipart/form-data" >
                            @csrf
                            @if(session('status'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-alert card cyan">
                                            <div class="card-content white-text">
                                                <p>{{ session('status') }}</p>
                                            </div>
                                            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col s12 m12">
                                    <div class="row">
                                        <div class="col s12 input-field mb-3">
                                            <label for="username">{{ __('Müşteri Logosu') }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s3 input-field">
                                            <input type="file" name="photo_path" id="input-file-max-fs" class="dropify" data-max-file-size="2M" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 input-field">
                                            <input id="name" name="name" type="text" class=" @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                                   data-error=".first_name">
                                            <label for="name">{{ __('Müşteri Adı') }}</label>
                                            @error('name')
                                            <small class="name">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col s4 input-field">
                                            <input id="agentName" name="agentName" type="text"
                                                   class=" @error('agentName') is-invalid @enderror"
                                                   value="{{ old('agentName') }}"
                                                   data-error=".agentName">
                                            <label for="email">{{ __('Firma Yetkilisi') }}</label>
                                        </div>
                                        <div class="col s4 input-field">
                                            <input id="phone" name="phone" type="text"
                                                   class=" @error('phone') is-invalid @enderror"
                                                   value="{{ old('phone') }}"
                                                   data-error=".phone">
                                            <label for="phone">{{ __('Telefon') }}</label>
                                        </div>
                                        <div class="col s4 input-field">
                                            <input id="email" name="email" type="text"
                                                   class=" @error('email') is-invalid @enderror"
                                                   value="{{ old('email') }}"
                                                   data-error=".email">
                                            <label for="email">{{ __('E-Posta') }}</label>
                                        </div>
                                        <div class="col s12 input-field">
                                            <textarea name="address" id="address" cols="30" rows="5" class="materialize-textarea @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                            <label for="description">{{ __('Adres') }}</label>
                                            @error('address')
                                                <small class="address">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="col s6 input-field">
                                            <select name="representative" id="representative">
                                                @foreach(\App\User::all() as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->fullName }}</option>
                                                @endforeach
                                            </select>
                                            <label for="username">{{ __('Müşteri Temsilcisi') }}</label>
                                        </div>
                                        <div class="col s6 input-field">
                                            <select name="customer_type" id="customer_type">
                                                <option value="1">Müşteri</option>
                                                <option value="2">Potansiyel Müşteri</option>
                                                <option value="3">Müşteri Değil</option>
                                            </select>
                                            <label for="username">{{ __('Müşteri Tipi') }}</label>
                                        </div>
                                        <div class="col s6">
                                            <label>
                                                <input name="status" type="radio" value="1" checked />
                                                <span>Aktif</span>
                                            </label>
                                        </div>
                                        <div class="col s6">
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
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/dropify/css/dropify.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('backend/vendors/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/js/scripts/form-file-uploads.js') }}"></script>
@endsection