@extends('backend.layouts.layout')
@section('headersubcontent')
    <div class="col s10 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Domain Detayları</span></h5>
    </div>
    <div class="col s2 m6 l6">
        <a href="{{ url()->previous() }}" class="ml-3 btn-floating waves-effect waves-light amber darken-4 tooltipped right" data-position="bottom" data-tooltip="Geri"><i class="material-icons left">arrow_back</i></a>
        <a href="{{ route('domains.edit',['id'=>$domainInfo->id]) }}" class="ml-3 btn-floating waves-effect waves-light cyan tooltipped right" data-position="bottom" data-tooltip="Düzenle"><i class="material-icons left">edit</i></a>
    </div>
@endsection
@section('content')
    <div class="section users-view">
        <!-- users view media object start -->
        <div class="card-panel">
            <div class="row">
                <div class="col s12 m7">
                    <div class="display-flex media">
                        <a href="#" class="avatar" style="display: none;">
                            <img src="" alt="users view avatar" class="z-depth-4 circle"
                                 height="64" width="64">
                        </a>
                        <div class="media-body">
                            <h6 class="media-heading">
                                <span class="users-view-name" style="font-size: 1.70rem;">
                                    <a href="{{ $domainInfo->name }}" target="_blank">{{ $domainInfo->name }}</a>
                                </span>
                            </h6>
                            <span class="users-view-id">
                                <b>Son Güncelleme :</b> {{ $domainInfo->DomainUpdate }} - <b>Kalan Süre : </b>{{ $domainInfo->Deadline }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                    <div class="display-flex media">
                        <div class="media-body">
                            <span class="users-view-id">
                                <a href="{{ $domainInfo->name }}" target="_blank" class="btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange tooltipped right" data-position="bottom" data-tooltip="Siteye Görüntüle" style="position: relative;top: -6px;"><i class="material-icons left">remove_red_eye</i></a>
                                <span class="chip blue lighten-5">
                                    <span class="blue-text">{{ $domainInfo->DomainRenewalStatus }}</span>
                                </span>
                                <span class="chip {{ $domainInfo->domainStatus['color'] }} lighten-5">
                                    <span class="{{ $domainInfo->domainStatus['color'] }}-text">{{$domainInfo->domainStatus['is_active']}}</span>
                                </span>
                                {{ $domainInfo->DomainSsl }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- users view media object ends -->
        <!-- users view card data start -->
        <div class="card">
            <div class="card-content" style="padding: 0;padding-left: 12px;">
                <ul class="tabs row">
                    <li class="tab">
                        <a class="display-flex align-items-center active" id="account-tab" href="#taskinfo">
                            <i class="material-icons mr-1">info</i><span>Domain Bilgileri</span>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="display-flex align-items-center" id="information-tab" href="#comments">
                            <i class="material-icons mr-2">comments</i><span>Yorumlar</span>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="display-flex align-items-center" id="information-tab" href="#documents">
                            <i class="material-icons mr-2">attach_file</i><span>Dokümanlar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @include('backend.domain.info')
        @include('backend.domain.comment')
        @include('backend.domain.file')
    <!-- users view card data ends -->
    </div>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/pages/app-email.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/pages/app-file-manager.css') }}">
    <style>
        .app-email .content-area {
            width: 100%;
            margin-top: 0;
        }
        textarea.materialize-textarea {
            min-height: 7rem;
        }
        #commentcancel{
            display: none;
        }
        #commentadd{
            padding: 7px 25px;
        }
        #documentcancel{
            display: none;
        }
        #documentadd{
            padding: 7px 25px;
        }
        .file-field {
            margin: 0;
        }
        .app-file-name.font-weight-700 {
            height: 45px;
            display: table;
        }
        .app-file-name.font-weight-700 a {
            display: table-cell;
            vertical-align: middle;
        }
        .app-file-area .app-file-content .app-file-recent-access .card .recent-file, .app-file-area .app-file-content .app-file-files .card .recent-file, .app-file-area .app-file-content .app-file-folder .card .recent-file {
            display: block;
            margin: 25px auto;
            height: 56px;
            width: 56px;
        }
        .app-file-area .app-file-content .app-file-recent-access .card .fonticon, .app-file-area .app-file-content .app-file-files .card .fonticon, .app-file-area .app-file-content .app-file-folder .card .fonticon {
            position: absolute;
            right: 11px;
            top: 13px;
        }
    </style>
@endsection
@section('js')
    <script src="{{ asset('backend/js/scripts/app-email.js') }}"></script>
    <script src="{{ asset('backend/js/scripts/app-file-manager.js') }}"></script>
    <script>
        $( "#commentaddbtn" ).click(function() {
            $( "#commentcancel" ).css('display','block');
            $( "#commentadd" ).css('display','none');
        });
        $( "#commentcancelbtn" ).click(function() {
            $( "#commentcancel" ).css('display','none');
            $( "#commentadd" ).css('display','block');
        });

        function commentcancelfunc(id) {
            $('#commentedit'+id).css('display','none');
            $('#commentcancelbutton'+id).css('display','none');
            $('#commenteditbutton'+id).css('display','block');
        }

        function commenteditfunc(id) {
            $('#commentedit'+id).css('display','block');
            $('#commentcancelbutton'+id).css('display','block');
            $('#commenteditbutton'+id).css('display','none');
        }

        $( "#documentaddbtn" ).click(function() {
            $( "#documentcancel" ).css('display','block');
            $( "#documentadd" ).css('display','none');
        });
        $( "#documentcancelbtn" ).click(function() {
            $( "#documentcancel" ).css('display','none');
            $( "#documentadd" ).css('display','block');
        });
    </script>
@endsection