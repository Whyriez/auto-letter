 <div id="sidebar"
     class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 sidebar-transition">
     <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200">
         <div class="flex items-center">
             <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center mr-3">
                 <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                     </path>
                 </svg>
             </div>
             <span class="text-xl font-bold logo-text">AutoLetter</span>
         </div>
         <button id="close-sidebar" class="lg:hidden text-gray-500 hover:text-gray-700">
             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                 </path>
             </svg>
         </button>
     </div>

     <nav class="mt-6 px-3">
         @if (Auth::user()->role === 'super_admin')
             <a href="{{ route('super_admin.dashboard') }}"
                 class="flex items-center px-3 py-2 rounded-lg mb-1 transition-colors 
          text-gray-700 hover:bg-gray-100 @yield('dashboard')">
                 <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z" />
                 </svg>
                 Dashboard
             </a>

             <a href="{{ route('super_admin.users') }}"
                 class="flex items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('users')">
                 <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z" />
                 </svg>
                 User Management
             </a>
         @endif


         {{-- ! Kajur --}}
         @if (Auth::user()->role === 'kajur')
             <a href="#"
                 class="flex items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('kajur-dashboard')">
                 <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z" />
                 </svg>
                 Approval Dashboard
             </a>
         @endif

         {{--! Mahasiswa --}}
         <a href="#"
             class="flex items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('mahasiswa-dashboard')">
             <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z" />
             </svg>
             Dashboard
         </a>



         <a href="#" onclick="openLogoutModal()"
             class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
             <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                 </path>
             </svg>
             Logout
         </a>

     </nav>

     <div class="absolute bottom-0 w-full p-4 border-t border-gray-200">
         <div class="flex items-center">
             <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                 <span class="text-red-600 font-semibold text-sm">
                     {{ collect(explode(' ', Auth::user()->name))->map(fn($word) => Str::upper(Str::substr($word, 0, 1)))->implode('') }}
                 </span>
             </div>
             <div class="flex-1">
                 <p class="text-sm font-medium text-gray-900">{{ Str::title(Auth::user()->name) }}</p>
                 <p class="text-xs text-gray-500">System Administrator</p>
             </div>
         </div>
     </div>
 </div>
