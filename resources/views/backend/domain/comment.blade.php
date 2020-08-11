<div id="comments">
    <div class="card">
        <div class="card-content" id="commentadd">
            <div class="row">
                <div class="col s12 m6">
                    <h6 class="mb-2 mt-2"><b>Yorumlar</b></h6>
                </div>
                <div class="col s12 m6 text-right">
                    <button class="btn waves-effect waves-light cyan" type="submit" name="action" id="commentaddbtn">
                        <i class="material-icons left">send</i> Yorum Yap
                    </button>
                </div>
            </div>
        </div>
        <div class="card-content" id="commentcancel">
            <form class="row" method="POST" action="{{ route('domaincomments.store') }}">
                @csrf
                <input type="hidden" name="domain_id" value="{{ $domainInfo->id }}">
                <div class="col s12 m12">
                    <textarea name="comments" id="comments" class="materialize-textarea @error('comments') is-invalid @enderror" placeholder="Yorumunuz" style="background: #fbfbfba6;padding: 7px;">{{ old('comments') }}</textarea>
                    @error('comments')
                    <small class="comments">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="col s12 m12 commentcancel">
                    <button class="btn waves-effect waves-light green right" type="submit" name="action">
                        <i class="material-icons left">send</i> Gönder
                    </button>
                    <button class="btn waves-effect waves-light red right mr-1" type="button" id="commentcancelbtn">
                        <i class="material-icons left">cancel</i> Vazgeç
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="app-email">
        <div class="card content-area">
            <div class="card-content app-wrapper">
                <div class="collection email-collection">
                    @foreach(\App\DomainComments::where('domain_id',$domainInfo->id)->orderBy('id','desc')->get() as $key => $value)

                        <div class="email-brief-info collection-item animate fadeUp delay-1">
                            <div class="list-content">
                                <div class="list-title-area">
                                    <div class="user-media">
                                        <img src="{{ $value->CommentUserInfo['image'] }}" class="circle z-depth-2 responsive-img avtar">
                                        <div class="list-title">
                                            <a href="{{ route('users.detail',['id'=>$value->CommentUserInfo['id']]) }}" target="_blank" class="tooltipped" data-position="bottom" data-tooltip="Kullanıcıyı Göster">
                                                {{ $value->CommentUserInfo['fullName'] }}
                                            </a>
                                            <br>
                                            <span style="color: #a5a5a5;font-size: 13px;">
                                                 {{ $value->CommentAddTime }}
                                                @if($value->created_at!=$value->updated_at)
                                                    - {{ $value->CommentEditTime }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-desc">
                                    {{ $value->comment }}
                                </div>
                            </div>
                            <div class="list-right">
                                <div class="favorite">
                                    <a href="{{ route('domaincomments.like',['id'=>$value->id]) }}" class="tooltipped" data-position="bottom" data-tooltip="Beğeni ({{ $value->likeCount }})">
                                        <i class="material-icons {{ $value->likeControl }}">star</i>
                                    </a>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::id()==$value->user_id)
                                    <div class="favorite">
                                        <a onclick="commenteditfunc('{{ $value->id }}')" class="tooltipped" data-position="bottom" data-tooltip="Düzenle" id="commenteditbutton{{ $value->id }}"><i class="material-icons green-text">edit</i></a>
                                        <a onclick="commentcancelfunc('{{ $value->id }}')"  class="tooltipped" data-position="bottom" data-tooltip="Vazgeç" id="commentcancelbutton{{ $value->id }}" style="display: none"><i class="material-icons red-text">cancel</i></a>
                                    </div>
                                    <div class="favorite">
                                        <a href="{{ route('domaincomments.destroy',['id'=>$value->id]) }}" class="tooltipped" data-position="bottom" data-tooltip="Sil"><i class="material-icons red-text">delete</i></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::id()==$value->user_id)
                            <form class="row m-0" id="commentedit{{ $value->id }}" method="POST" action="{{ route('domaincomments.update',['id'=>$value->id]) }}" style="display: none">
                                @csrf
                                <input type="hidden" name="domain_id" value="{{ $domainInfo->id }}">
                                <div class="col s12 m11">
                                    <textarea name="comments" id="comments" class="materialize-textarea @error('comments') is-invalid @enderror" placeholder="Yorumunuz" style="background: #fbfbfba6;padding: 7px;">{{ $value->comment }}</textarea>
                                    @error('comments')
                                    <small class="comments">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col s12 m1" style="padding-top: 13px;">
                                    <button class="ml-3 btn-floating waves-effect waves-light gradient-45deg-green-teal tooltipped right" type="submit" name="action" data-position="bottom" data-tooltip="Gönder">
                                        <i class="material-icons left">send</i>
                                    </button>
                                </div>
                            </form>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>