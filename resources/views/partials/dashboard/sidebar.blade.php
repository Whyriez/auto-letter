 <div id="sidebar"
     class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 sidebar-transition">
     <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200">
         <div class="flex items-center">

             <a href="{{ url('/') }}" class="flex items-center">
                 <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center mr-3">
                     <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                         </path>
                     </svg>
                 </div>
                 <span class="text-xl font-bold logo-text">AutoLetter</span>
             </a>
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
                 class="flex gap-3 items-center px-3 py-2 rounded-lg mb-1 transition-colors 
          text-gray-700 hover:bg-gray-100 @yield('dashboard')">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z" />
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

         @if (Auth::user()->role === 'admin_jurusan')
             <a href="{{ route('admin_jurusan.dashboard') }}"
                 class="flex gap-3 items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('admin-jurusan-dashboard')">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z" />
                 </svg>
                 Dashboard
             </a>

             <!-- Data Surat: ikon dokumen dengan garis-garis (representasi data/list) -->
             <a href="{{ route('surat.index') }}"
                 class="flex items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('surat')">
                 <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                     <rect x="4" y="3" width="16" height="18" rx="2" stroke-width="2" />
                     <line x1="8" y1="8" x2="16" y2="8" stroke-width="2"
                         stroke-linecap="round" />
                     <line x1="8" y1="12" x2="16" y2="12" stroke-width="2"
                         stroke-linecap="round" />
                     <line x1="8" y1="16" x2="16" y2="16" stroke-width="2"
                         stroke-linecap="round" />
                 </svg>
                 Data Surat
             </a>

             <!-- Template Surat: ikon dua dokumen bertumpuk (melambangkan template/duplikat) -->
             <a href="{{ route('template-surat.index') }}"
                 class="flex items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('template-surat')">
                 <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                     <!-- lembar belakang -->
                     <rect x="5" y="4" width="12" height="14" rx="2" stroke-width="2" opacity=".6" />
                     <!-- lembar depan -->
                     <rect x="7" y="6" width="12" height="14" rx="2" stroke-width="2" />
                     <!-- garis contoh pada template -->
                     <line x1="10" y1="11" x2="16" y2="11" stroke-width="2"
                         stroke-linecap="round" />
                     <line x1="10" y1="15" x2="16" y2="15" stroke-width="2"
                         stroke-linecap="round" />
                 </svg>
                 Template Surat
             </a>

             <!-- Jenis Surat: ikon tag/kategori (melambangkan jenis/klasifikasi) -->
             <a href="{{ route('jenis-surat.index') }}"
                 class="flex items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('jenis-surat')">
                 <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     aria-hidden="true">
                     <path d="M4 10V7a2 2 0 0 1 2-2h4l9.3 9.3a2 2 0 0 1 0 2.8L16.1 20.3a2 2 0 0 1-2.8 0L4 10z"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                     <circle cx="9" cy="7.5" r="1.2" stroke-width="2" />
                 </svg>
                 Jenis Surat
             </a>
         @endif

         @if (Auth::user()->role === 'kaprodi')
             <a href="{{ route('kaprodi.index') }}"
                 class="flex gap-3 items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('kaprodi-dashboard')">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z" />
                 </svg>
                 Dashboard
             </a>

             <a href="{{ route('kaprodi.riwayat') }}"
                 class="flex gap-3 items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('kajur-riwayat')">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                 </svg>
                 Riwayat
             </a>
         @endif

         @if (Auth::user()->role === 'kajur')
             <a href="{{ route('kajur.index') }}"
                 class="flex gap-3 items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('kajur-dashboard')">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z" />
                 </svg>
                 Dashboard
             </a>

             <a href="{{ route('kajur.riwayat') }}"
                 class="flex gap-3 items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('kajur-riwayat')">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                 </svg>
                 Riwayat
             </a>
         @endif

         @if (Auth::user()->role === 'mahasiswa')
             <a href="{{ route('mahasiswa.index') }}"
                 class="flex gap-3 items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('mahasiswa-dashboard')">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z" />
                 </svg>
                 Dashboard
             </a>
         @endif

         @if (!in_array(Auth::user()->role, ['super_admin', 'admin_jurusan']))
             <a href="{{ route('dashboard.setting') }}"
                 class="flex gap-3 items-center px-3 py-2 rounded-lg mb-1 transition-colors font-medium text-gray-700 hover:bg-gray-100 @yield('profile-settings')">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     stroke-width="2" class="w-5 h-5">
                     <path stroke-linecap="round" stroke-linejoin="round"
                         d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.01c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.01 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.01 2.573c.94 1.543-.827 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.01c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.01c-1.543.94-3.31-.827-2.37-2.37a1.724 1.724 0 00-1.01-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.01-2.573c-.94-1.543.827-3.31 2.37-2.37.966.59 2.142.17 2.573-1.01z" />
                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                 </svg>

                 Setting Profile
             </a>
         @endif

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
                 <p class="text-xs text-gray-500">
                     @php
                         $role = Auth::user()->role;
                         $jurusan = Auth::user()->jurusan;
                         $prodi = Auth::user()->prodi;
                         $name = Auth::user()->name;
                         $nim = Auth::user()->nim_nip;

                         switch ($role) {
                             case 'super_admin':
                                 echo 'Super Admin';
                                 break;
                             case 'mahasiswa':
                                 echo 'Mahasiswa';
                                 break;
                             case 'admin_jurusan':
                                 echo 'Admin Jurusan';
                                 break;
                             case 'kajur':
                                 echo 'Ketua Jurusan ' . $jurusan;
                                 break;
                             case 'kaprodi':
                                 echo 'Ketua Program Studi ' . $prodi;
                                 break;
                             default:
                                 echo Str::title($role);
                                 break;
                         }
                     @endphp
                 </p>
             </div>
         </div>
     </div>
 </div>
