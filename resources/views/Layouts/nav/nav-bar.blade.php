@yield('nav-bar')
{{-- Barra de navegacion --}}
<nav id="nav-buttons">
    <ul>
        <li class="link-nav">
            <a href="{{ route('home.index') }}">
                <div class="icon-button">
                    <i class='bx bx-cricket-ball'></i>
                    <span>Home</span>
                </div>
            </a>
        </li>
        <li class="link-nav">
            <a href="{{ route('histoty.index') }}">
                <div class="icon-button">
                    <i class='bx bx-paper-plane'></i>
                    <span>History</span>
                </div>
            </a>
        </li>

        @yield('btn-expenses-nav')
        @yield('btn-chests-nav')

        <li class="link-nav">
            <a href="{{ route('chests.index') }}">
                <div class="icon-button">
                    <i class='bx bx-credit-card'></i>
                    <span>Chests</span>
                </div>
            </a>
        </li>
        <li class="link-nav">
            {{-- <a href="{{ route('profile.show', []) }}"> --}}
            <a href="{{ route('profile.show', ['id'=>Auth::user()->id]) }}">
                <div class="icon-button">
                    <i class='bx bx-user'></i>
                    <span>Profile</span>
                </div>
            </a>
        </li>
    </ul>
</nav>
