<div id="taskinfo">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m12">
                    <h6 class="mb-2 mt-2"><i class="material-icons">info</i> Domain Detayları</h6>
                </div>
                <div class="col s12 m12 mb-2">
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td><b>Müşteri</b></td>
                                <td class="users-view-username">:
                                    @if($domainInfo->CustomerCtrl==true)
                                        <a target="_blank" href="{{ route('customers.show',['id'=>$domainInfo->CustomerInfo['id']])  }}" class="tooltipped" data-position="bottom" data-tooltip="Müşteriyi Göster">
                                            <img src="{{ $domainInfo->CustomerInfo['image'] }}" class="avatar-status"> {{ $domainInfo->CustomerInfo['name'] }}
                                        </a>
                                    @else
                                        <a href="javascript;;">
                                            Müşteri Yok
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 m6">
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td><b>Tescil Tarihi</b></td>
                                <td class="users-view-username">: {{ $domainInfo->DomainRegister }}</td>
                            </tr>
                            <tr>
                                <td><b>Son Güncelleme Tarihi</b></td>
                                <td class="users-view-username">: {{ $domainInfo->DomainUpdate }}</td>
                            </tr>
                            <tr>
                                <td><b>Bitiş Tarihi</b></td>
                                <td class="users-view-username">: {{ $domainInfo->DomainExpires }}</td>
                            </tr>
                            <tr>
                                <td><b>Ekleyen</b></td>
                                <td class="users-view-email">:
                                    <a href="{{ route('users.detail',['id'=>$domainInfo->DomainCreateUserInfo['id']]) }}" target="_blank" class="tooltipped" data-position="bottom" data-tooltip="Kullanıcıyı Göster">
                                        <img src="{{ $domainInfo->DomainCreateUserInfo['image'] }}" class="avatar-status"> {{ $domainInfo->DomainCreateUserInfo['fullName'] }}
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
                                <td><b>Yenileme Durumu</b></td>
                                <td class="users-view-username">: {{ $domainInfo->DomainRenewalStatus }}</td>
                            </tr>
                            <tr>
                                <td><b>Kimde</b></td>
                                <td class="users-view-username">: {{ $domainInfo->DomainAgency }}</td>
                            </tr>
                            <tr>
                                <td><b>Domain Sağlayıcı</b></td>
                                <td class="users-view-username">: {{ $domainInfo->DomainRegistrar }}</td>
                            </tr>
                            <tr>
                                <td><b>Hosting Sağlayıcı</b></td>
                                <td class="users-view-username">: {{ $domainInfo->DomainHosting }}</td>
                            </tr>
                            <tr>
                                <td><b>SSL</b></td>
                                <td class="users-view-username">: {{ $domainInfo->DomainSsl }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>