<div id="taskinfo">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m12">
                    <h6 class="mb-2 mt-2"><i class="material-icons">info</i> Görev Detayları</h6>
                </div>
                <div class="col s12 m6">
                    <table class="striped">
                        <tbody>
                        <tr>
                            <td><b>Başlama Tarihi</b></td>
                            <td class="users-view-username">: {{ $taskInfo->TaskStartDate }}</td>
                        </tr>
                        <tr>
                            <td><b>Ekleme Tarihi</b></td>
                            <td class="users-view-username">: {{ $taskInfo->taskCreatedAt }}</td>
                        </tr>
                        <tr>
                            <td><b>Müşteri</b></td>
                            <td class="users-view-username">:
                                @if($taskInfo->CustomerCtrl==true)
                                    <a target="_blank" href="{{ route('customers.show',['id'=>$taskInfo->CustomerInfo['id']])  }}" class="tooltipped" data-position="bottom" data-tooltip="Müşteriyi Göster">
                                        <img src="{{ $taskInfo->CustomerInfo['image'] }}" class="avatar-status"> {{ $taskInfo->CustomerInfo['name'] }}
                                    </a>
                                @else
                                    <a href="javascript;;">
                                        Müşteri Yok
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>Ekleyen</b></td>
                            <td class="users-view-email">:
                                <a href="{{ route('users.detail',['id'=>$taskInfo->TaskUserInfo['id']]) }}" target="_blank" class="tooltipped" data-position="bottom" data-tooltip="Kullanıcıyı Göster">
                                    <img src="{{ $taskInfo->TaskUserInfo['image'] }}" class="avatar-status"> {{ $taskInfo->TaskUserInfo['fullName'] }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Atanan</b></td>
                            <td class="users-view-email">:
                                <a href="{{ route('users.detail',['id'=>$taskInfo->TaskCreateUserInfo['id']]) }}" target="_blank" class="tooltipped" data-position="bottom" data-tooltip="Kullanıcıyı Göster">
                                    <img src="{{ $taskInfo->TaskCreateUserInfo['image'] }}" class="avatar-status"> {{ $taskInfo->TaskCreateUserInfo['fullName'] }}
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 m6">
                    <table class="striped">
                        <tbody>
                        <tr>
                            <td><b>Bitiş Tarihi</b></td>
                            <td class="users-view-username">: {{ $taskInfo->TaskFinishDate }}</td>
                        </tr>
                        <tr>
                            <td><b>Son Güncelleme Tarihi</b></td>
                            <td class="users-view-name">: {{ $taskInfo->taskUpdatedAt }}</td>
                        </tr>
                        <tr>
                            <td><b>Öncelik</b></td>
                            <td class="users-view-email">
                                : <span class="{{ $taskInfo->taskPriority['color'] }}-text">{{$taskInfo->taskPriority['is_active']}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Durum</b></td>
                            <td class="users-view-email">
                                : <span class="{{ $taskInfo->taskStatus['color'] }}-text">{{$taskInfo->taskStatus['is_active']}}</span>
                            </td>
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
                    <h6 class="mb-2 mt-2"><i class="material-icons">info</i> Açıklama</h6>
                </div>
                <div class="col s12 m12">
                    <p>
                        {{ $taskInfo->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>