<nav class="navbar navbar-dark bg-dark navbar-expand-lg justify-content-between">
    <a class="navbar-brand" href="{{ route('user.home') }}">Questify</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="flex-grow: 0;">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('quest.all') }}">All quests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.all-quests', [Auth::user()->name]) }}">My quests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.profile', [Auth::user()->name]) }}">My Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.quests-in-process', [Auth::user()->name]) }}">Quests in process</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.quests-finished', [Auth::user()->name]) }}">Quests finished</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.quests-failed', [Auth::user()->name]) }}">Quests failed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    <button type="submit" class="nav-link">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>