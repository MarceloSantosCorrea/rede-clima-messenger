<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
        @if(\Auth::user()->thumbnail)
            <img src="{{ url('storage/thumbnails/' . Auth::user()->thumbnail) }}" alt="user-image" class="rounded-circle">
        @endif
        <span class="pro-user-name ml-1">
            {{ \Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
        <div class="dropdown-header noti-title">
            <h6 class="text-overflow m-0">Bem Vindo!</h6>
        </div>

        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="fe-user"></i>
            <span>Meus Dados</span>
        </a>

        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="fe-settings"></i>
            <span>Configurações</span>
        </a>

        <div class="dropdown-divider"></div>

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
            <i class="fe-log-out"></i>
            <span>Sair</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

    </div>
</li>