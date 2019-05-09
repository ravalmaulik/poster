<div class="brand-sidebar">
    <h1 class="logo-wrapper">
        <a class="brand-logo darken-1" href="index.html">
            <img src="{{asset('assets/images/logo/materialize-logo-color.png')}}" alt="materialize logo"/><span class="logo-text hide-on-med-and-down">Poster</span>
        </a>
        <a class="navbar-toggler" href="#">
            <i class="material-icons">radio_button_checked</i>
        </a>
    </h1>
</div>
<ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
    @foreach($menu as $value)
        <li class="bold">
            @if(count($value->subMenu)>0)
                <a class=" waves-effect waves-cyan collapsible-header" href="#">
                    
                    <span class="menu-title" data-i18n>{{$value->MenuName}}</span>
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        @foreach($value->subMenu as $subMenu)
                            <li>
                                <a class="collapsible-body" href="{{route($subMenu->MenuLink)}}" data-i18n="">
                                    <i class="material-icons">radio_button_unchecked</i>
                                    <span>{{$subMenu->MenuName}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <a class=" waves-effect waves-cyan" href="{{route($value->MenuLink)}}">
                    <span class="menu-title" data-i18n>{{$value->MenuName}}</span>
                </a>
            @endif
        </li>
    @endforeach
</ul>
<div class="navigation-background">
</div>
<a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out">
    <i class="material-icons">menu</i>
</a>