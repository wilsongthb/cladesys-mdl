<div class="mdl-layout__drawer">
    <nav class="mdl-navigation">
        @if (!Auth::guest())
        <span class="mdl-navigation__link">
            <i class="material-icons" role="presentation">face</i> {{ Auth::user()->name }}
        </span>
        <a 
            class="mdl-navigation__link"
            href="{{ route('logout') }}" 
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="material-icons" role="presentation">exit_to_app</i> Salir
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        @else
        <a href="{{ route('login') }}" class="mdl-navigation__link"><i class="material-icons" role="presentation">account_box</i> Login</a>
        <a href="{{ route('register') }}" class="mdl-navigation__link"><i class="material-icons" role="presentation">add_circle</i> Register</a>
        @endif
        <hr>
        <a class="mdl-navigation__link" href="{{ url('/logistic') }} "><i class="material-icons" role="presentation">home</i> Principal</a>
        <hr>
        <a class="mdl-navigation__link" href="{{ url('/logistic/templates') }} "><i class="material-icons" role="presentation">flag</i> Templates</a>
        <a class="mdl-navigation__link" href=""><i class="material-icons" role="presentation">inbox</i> Inbox</a>
        <a class="mdl-navigation__link" href=""><i class="material-icons" role="presentation">delete</i> Trash</a>
        <a class="mdl-navigation__link" href=""><i class="material-icons" role="presentation">report</i> Spam</a>
        <a class="mdl-navigation__link" href=""><i class="material-icons" role="presentation">forum</i> Forums</a>
        <a class="mdl-navigation__link" href=""><i class="material-icons" role="presentation">flag</i> Updates</a>
        <a class="mdl-navigation__link" href=""><i class="material-icons" role="presentation">local_offer</i> Promos</a>
        <a class="mdl-navigation__link" href=""><i class="material-icons" role="presentation">shopping_cart</i> Purchases</a>
        <a class="mdl-navigation__link" href=""><i class="material-icons" role="presentation">people</i> Social</a>
        <div class="mdl-layout-spacer"></div>
        <a class="mdl-navigation__link" href=""><i class="material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
    </nav>
</div>