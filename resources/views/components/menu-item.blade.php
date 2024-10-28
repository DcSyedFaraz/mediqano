<li class="{{ $getClasses() }}">
    @if ($action === 'logout')
        <!-- Logout Link -->
        <a class="menu-link {{ $class ?? '' }}" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="menu-icon tf-icons {{ $icon }}"></i>
            <span class="align-middle">{{ $slot }}</span>
        </a>
        <!-- Hidden Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @elseif($hasSub)
        <!-- Menu Item with Submenu -->
        <a href="javascript:void(0);" class="menu-link menu-toggle" aria-haspopup="true"
            aria-expanded="{{ $hasSub && $active ? 'true' : 'false' }}">
            <i class="menu-icon tf-icons {{ $icon }}"></i>
            <span class="align-middle">{{ $slot }}</span>
        </a>
        <ul class="menu-sub" aria-label="submenu">
            {{ $submenu }}
        </ul>
    @else
        <!-- Regular Menu Link -->
        <a href="{{ route($route) }}" class="menu-link">
            <i class="menu-icon tf-icons {{ $icon }}"></i>
            <span class="align-middle">{{ $slot }}</span>
        </a>
    @endif
</li>
