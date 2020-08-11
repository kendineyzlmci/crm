@extends('backend.layouts.layout')
@section('headersubcontent')
    <div class="col s10 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Görev Ekle</span></h5>
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
                        <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data" >
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
                                        <div class="col s12 input-field">
                                            <input id="title" name="title" type="text" class=" @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                                   data-error=".first_name">
                                            <label for="title">{{ __('Başlık') }}</label>
                                            @error('title')
                                                <small class="title">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="col s12 input-field">
                                            <textarea name="description" id="description" cols="30" rows="30" class="materialize-textarea @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                            <label for="description">{{ __('Açıklama') }}</label>
                                            @error('description')
                                                <small class="description">
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
                                            <select name="task_user" id="task_user">
                                                 @foreach(\App\User::all() as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->fullName }}</option>
                                                @endforeach
                                            </select>
                                            <label for="username">{{ __('Atacanak Kullanıcı') }}</label>
                                        </div>
                                        <div class="col s4 input-field">
                                            <input id="start_date" name="start_date" type="date" class=" @error('start_date') is-invalid @enderror" value="{{ date('Y-m-d') }}"
                                                   data-error=".start_date">
                                            <label for="start_date">{{ __('Başlama Tarihi') }}</label>
                                            @error('start_date')
                                            <small class="start_date">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col s4 input-field">
                                            <input id="finish_date" name="finish_date" type="date" class=" @error('finish_date') is-invalid @enderror" value="{{ date('Y-m-d') }}"
                                                   data-error=".finish_date">
                                            <label for="finish_date">{{ __('Bitiş Tarihi') }}</label>
                                            @error('finish_date')
                                            <small class="finish_date">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col s4 input-field">
                                            <select name="priority" id="priority">
                                                <option value="1">Normal</option>
                                                <option value="2">Acil</option>
                                                <option value="3">Acil Acil</option>
                                            </select>
                                            <label for="username">{{ __('Önem Durumu') }}</label>
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