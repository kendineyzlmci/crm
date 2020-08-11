@extends('backend.layouts.layout')
@section('headersubcontent')
    <div class="col s10 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Müşteri Ekle</span></h5>
    </div>
    <div class="col s2 m6 l6">
        <a href="{{ url()->previous() }}"
           class="ml-3 btn-floating waves-effect waves-light amber darken-4 tooltipped right" data-position="bottom"
           data-tooltip="Geri"><i class="material-icons left">arrow_back</i></a>
    </div>
@endsection
@section('content')
    <div class="section users-edit">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12" id="account">
                        <!-- users edit account form start -->
                        <form method="POST" action="{{ route('customers.update',['id'=>$customerInfo->id]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @if(session('status'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-alert card cyan">
                                            <div class="card-content white-text">
                                                <p>{{ session('status') }}</p>
                                            </div>
                                            <button type="button" class="close white-text" data-dismiss="alert"
                                                    aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col s12 m4">
                                    <div class="row">
                                        <div class="col s12 input-field mb-3">
                                            <label for="username">{{ __('Müşteri Logosu') }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 input-field">
                                            <img src="{{ $customerInfo->image }}" alt=""
                                                 style="width: 100%;margin: 0 auto;display: block;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 input-field">
                                            <input type="file" name="photo_path" id="input-file-max-fs" class="dropify"
                                                   data-max-file-size="2M"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m8">
                                    <div class="row">
                                        <div class="col s12 input-field">
                                            <input id="name" name="name" type="text"
                                                   class=" @error('name') is-invalid @enderror"
                                                   value="{{ $customerInfo->name }}"
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
                                                   value="{{ $customerInfo->agentName }}"
                                                   data-error=".agentName">
                                            <label for="email">{{ __('Firma Yetkilisi') }}</label>
                                        </div>
                                        <div class="col s4 input-field">
                                            <input id="phone" name="phone" type="text"
                                                   class=" @error('phone') is-invalid @enderror"
                                                   value="{{ $customerInfo->phone }}"
                                                   data-error=".phone">
                                            <label for="phone">{{ __('Telefon') }}</label>
                                        </div>
                                        <div class="col s4 input-field">
                                            <input id="email" name="email" type="text"
                                                   class=" @error('email') is-invalid @enderror"
                                                   value="{{ $customerInfo->email }}"
                                                   data-error=".email">
                                            <label for="email">{{ __('E-Posta') }}</label>
                                        </div>
                                        <div class="col s12 input-field">
                                            <textarea name="address" id="address" cols="30" rows="5" class="materialize-textarea @error('address') is-invalid @enderror">{{ $customerInfo->address }}</textarea>
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
                                                    <option @if($value->id==$customerInfo->representative) selected
                                                            @endif value="{{ $value->id }}">{{ $value->fullName }}</option>
                                                @endforeach
                                            </select>
                                            <label for="username">{{ __('Müşteri Temsilcisi') }}</label>
                                        </div>
                                        <div class="col s6 input-field">
                                            <select name="customer_type" id="customer_type">
                                                <option @if($customerInfo->customer_type==1) selected @endif value="1"> Müşteri</option>
                                                <option @if($customerInfo->customer_type==2) selected @endif value="2">Potansiyel Müşteri</option>
                                                <option @if($customerInfo->customer_type==3) selected @endif value="3">Müşteri Değil</option>
                                            </select>
                                            <label for="username">{{ __('Müşteri Tipi') }}</label>
                                        </div>
                                        <div class="col s6">
                                            <label>
                                                <input name="status" type="radio" value="1"
                                                       @if($customerInfo->status ==1) checked @endif/>
                                                <span>Aktif</span>
                                            </label>
                                        </div>
                                        <div class="col s6">
                                            <label>
                                                <input name="status" type="radio" value="0"
                                                       @if($customerInfo->status==0) checked @endif/>
                                                <span>Pasif</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 display-flex justify-content-end mt-3">
                                    <button type="submit" class="btn indigo">
                                        {{ __('Güncelle') }}
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