<!-- Sidebar -->
<nav id="sidebar" class="w-64 bg-base-200 flex-shrink-0 sticky top-16 h-[calc(100vh-4rem)] overflow-y-auto p-2">
    <ul class="menu menu-vertical w-full">
        <li>
            <a href="{{ route('welcome') }}" class="sidebar-link {{ request()->routeIs('welcome') ? 'active bg-base-300' : '' }}">
                <i class="fas fa-home text-xl flex-shrink-0"></i>
                <span class="sidebar-text">Home</span>
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
                    <i class="{{ \App\Models\Article::getCategoryIcon($category) }} text-xl flex-shrink-0"></i>
                    <span class="sidebar-text">{{ \App\Models\Article::getCategoryDisplayName($category) }}</span>
                </a>
            </li>
            @endforeach
        @endif
    </ul>
</nav>
