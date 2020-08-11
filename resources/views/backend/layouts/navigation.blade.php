<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ url('/') }}"><img class="hide-on-med-and-down" src="{{ asset('backend/images/logo/materialize-logo-color.png') }}" alt="materialize logo"/><img class="show-on-medium-and-down hide-on-med-and-up" src="{{ asset('backend/images/logo/materialize-logo.png') }}" alt="materialize logo"/><span class="logo-text hide-on-med-and-down">Materialize</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="bold">
            <a class="waves-effect waves-cyan" href="{{ url('/') }}">
                <i class="material-icons">dashboard</i><span class="menu-title" data-i18n="">Anasayfa</span>
            </a>
        </li>
        <li class="bold">
            <a class="waves-effect waves-cyan" href="{{ route('tasks.list') }}">
                <i class="material-icons">storage</i><span class="menu-title" data-i18n="">Görevler</span>
            </a>
        </li>
        <li class="bold">
            <a class="waves-effect waves-cyan" href="{{ route('domains.list') }}">
                <i class="material-icons">public</i><span class="menu-title" data-i18n="">Domainler</span>
            </a>
        </li>
        <li class="bold">
            <a class="waves-effect waves-cyan" href="{{ route('customers.list') }}">
                <i class="material-icons">business_center</i><span class="menu-title" data-i18n="">Müşteriler</span>
            </a>
        </li>
        <li class="bold">
            <a class="waves-effect waves-cyan" href="{{ route('users.list') }}">
                <i class="material-icons">person_outline</i><span class="menu-title" data-i18n="">Kullanıcılar</span>
            </a>
        </li>
        <li class="bold">
            <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
                <i class="material-icons">settings</i><span class="menu-title" data-i18n="">Ayarlar</span>
            </a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a href=""><i class="material-icons">radio_button_unchecked</i><span data-i18n="">Görev Ayarları</span></a>
                    </li>
                    <li>
                        <a href=""><i class="material-icons">radio_button_unchecked</i><span data-i18n="">Müşteri Ayarları</span></a>
                    </li>
                    <li>
                        <a href=""><i class="material-icons">radio_button_unchecked</i><span data-i18n="">Domain Ayarları</span></a>
                    </li>
                    <li>
                        <a href=""><i class="material-icons">radio_button_unchecked</i><span data-i18n="">Kullanıcı Ayarları</span></a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>