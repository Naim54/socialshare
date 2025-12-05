<!-- Sidebar -->
<nav id="sidebar" class="hidden md:block w-64 bg-base-200 flex-shrink-0 sticky top-16 h-[calc(100vh-4rem)] overflow-y-auto transition-all duration-300 ease-in-out md:translate-x-0">
    <div class="p-4">
        <ul class="menu menu-vertical w-full space-y-1">
            <li>
                <a href="{{ route('welcome') }}" 
                   class="sidebar-link group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 ease-in-out 
                          {{ request()->routeIs('welcome') 
                             ? 'bg-base-content/50 border-l-4 border-primary font-semibold shadow-lg active' 
                             : 'hover:bg-base-300 hover:shadow-sm hover:scale-[1.02]' }}">
                    <i class="fas fa-home text-xl flex-shrink-0 transition-transform duration-300 {{ request()->routeIs('welcome') ? 'scale-110' : 'group-hover:scale-110' }}"></i>
                    <span class="sidebar-text font-medium whitespace-nowrap overflow-hidden transition-all duration-300 ease-in-out">Home</span>
                </a>
            </li>
            
            <li class="sidebar-divider"><div class="divider my-2 opacity-30 transition-opacity duration-300"></div></li>
            
            <li class="menu-title px-4 py-2 sidebar-title">
                <span class="sidebar-text text-xs font-semibold uppercase tracking-wider text-base-content/60 whitespace-nowrap overflow-hidden transition-all duration-300 ease-in-out">Categories</span>
            </li>

            @if(isset($categories) && count($categories) > 0)
                @foreach($categories as $category)
                @php
                    $isActive = request()->routeIs('category.show') && request()->route('category') === $category;
                @endphp
                <li>
                    <a href="{{ route('category.show', $category) }}" 
                       class="sidebar-link group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 ease-in-out
                              {{ $isActive 
                                 ? 'bg-base-content/50 border-l-4 border-primary font-semibold shadow-lg active' 
                                 : 'hover:bg-base-300 hover:shadow-sm hover:scale-[1.02] hover:translate-x-1' }}">
                        <i class="{{ \App\Models\Article::getCategoryIcon($category) }} text-xl flex-shrink-0 transition-transform duration-300 {{ $isActive ? 'scale-110' : 'group-hover:scale-110' }}"></i>
                        <span class="sidebar-text font-medium whitespace-nowrap overflow-hidden transition-all duration-300 ease-in-out">{{ \App\Models\Article::getCategoryDisplayName($category) }}</span>
                    </a>
                </li>
                @endforeach
            @endif
        </ul>
    </div>
</nav>
