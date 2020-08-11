<div id="documents">
    <div class="card">
        <div class="card-content" id="documentadd">
            <div class="row">
                <div class="col s12 m6">
                    <h6 class="mb-2 mt-2"><b>Dokümanlar</b></h6>
                </div>
                <div class="col s12 m6 text-right">
                    <button class="btn waves-effect waves-light cyan" type="submit" name="action" id="documentaddbtn">
                        <i class="material-icons left">attach_file</i> Doküman Ekle
                    </button>
                </div>
            </div>
        </div>
        <div class="card-content" id="documentcancel">
            <form class="row" method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="task_id" value="{{ $taskInfo->id }}">
                <div class="col s12 m6">
                    <input id="name" name="name" type="text" class=" @error('name') is-invalid @enderror" value="{{ old('name') }}"
                           data-error=".name">
                    <label for="name">{{ __('Dosya Adı') }}</label>
                    @error('name')
                    <small class="name">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="col s12 m6">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Doküman</span>
                            <input name="file" id="file" type="file" class="@error('file') is-invalid @enderror" >
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Dosya Seçiniz...">
                        </div>
                    </div>
                    @error('file')
                    <small class="file">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="col s12 m12 documentcancel">
                    <button class="btn waves-effect waves-light green right" type="submit" name="action">
                        <i class="material-icons left">attach_file</i> Ekle
                    </button>
                    <button class="btn waves-effect waves-light red right mr-1" type="button" id="documentcancelbtn">
                        <i class="material-icons left">cancel</i> Vazgeç
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-content app-file-area">
            <div class="app-file-content">
                <div class="row app-file-recent-access mb-3">
                    @foreach(\App\TaskFiles::where('task_id',$taskInfo->id)->orderBy('id','desc')->get() as $key => $value)
                        <div class="col xl3 l6 m4 s12">
                            <div class="card box-shadow-none mb-1 app-file-info">
                                <div class="card-content">
                                    <div class="app-file-content-logo grey lighten-4">
                                        <div class="fonticon">
                                            <a href="{{ $value->file }}" class="tooltipped green-text" download data-position="bottom" data-tooltip="İndir"><i class="material-icons">file_download</i></a>
                                            <a href="{{ $value->file }}" class="tooltipped blue-text" target="_blank" data-position="bottom" data-tooltip="Görüntüle"><i class="material-icons">remove_red_eye</i></a>
                                            <a href="{{ route('files.destroy',['id'=>$value->id]) }}" class="tooltipped red-text" data-position="bottom" data-tooltip="Sil"><i class="material-icons">delete</i></a>
                                        </div>
                                        <img class="recent-file" src="{{ $value->FileType }}" height="38" width="30"
                                             alt="Card image cap">
                                    </div>
                                    <div class="app-file-recent-details">
                                        <div class="app-file-name font-weight-700">
                                            <a href="{{ $value->file }}" target="_blank">{{ $value->name }}</a>
                                        </div>
                                        <div class="app-file-size">Boyut : <b>{{ $value->FileSize }}</b></div>
                                        <div class="app-file-last-access">
                                            {{ $value->FileAddTime }}
                                            @if($value->created_at!=$value->updated_at)
                                                <br>{{ $value->FileEditTime }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- App File - Recent Accessed Files Section Ends -->
            </div>
        </div>
    </div>
</div>