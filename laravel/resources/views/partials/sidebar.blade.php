<!-- Sidebar -->
<nav id="sidebar" class="w-64 bg-base-200 flex-shrink-0 sticky top-16 h-[calc(100vh-4rem)] overflow-y-auto p-2">
    <ul class="menu menu-vertical w-full">
        <li>
            <a href="{{ route('welcome') }}" class="sidebar-link {{ request()->routeIs('welcome') ? 'active bg-base-300' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span class="sidebar-text">Home</span>
            </a>
        </li>
        <li>
            <a href="#" class="sidebar-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                    <path d="M17.5 19c-2.9 0-5.5-2.6-5.5-5.5S14.6 8 17.5 8s5.5 2.6 5.5 5.5-2.6 5.5-5.5 5.5z"></path>
                    <path d="M12 17.5C12 14.6 9.4 12 6.5 12S1 14.6 1 17.5 3.6 23 6.5 23s5.5-2.6 5.5-5.5z"></path>
                    <path d="M6.5 12c0-2.9 2.6-5.5 5.5-5.5S17.5 9.1 17.5 12"></path>
                </svg>
                <span class="sidebar-text">Top Stories</span>
            </a>
        </li>
        
        <li><div class="divider my-2"></div></li>
        
        <li class="menu-title">
            <span class="sidebar-text">Categories</span>
        </li>

        @if(isset($categories) && count($categories) > 0)
            @foreach($categories as $category)
            <li>
                <a href="{{ route('category.show', $category) }}" class="sidebar-link {{ request()->routeIs('category.show') && request()->route('category') === $category ? 'active bg-base-300' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                        {!! \App\Models\Article::getCategoryIcon($category) !!}
                    </svg>
                    <span class="sidebar-text">{{ \App\Models\Article::getCategoryDisplayName($category) }}</span>
                </a>
            </li>
            @endforeach
        @endif
    </ul>
</nav>
