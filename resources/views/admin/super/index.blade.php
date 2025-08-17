@extends('layouts.admin.super-layout')

@section('content')
    <div class="lg:ml-64">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6">
                <div class="flex items-center">
                    <button id="menu-button" class="lg:hidden text-gray-500 hover:text-gray-700 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-900">User Management</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-500 hover:text-gray-700 relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-5 5v-5zM4 19h10a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="p-4 sm:p-6">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">System User Management</h2>
                <p class="text-gray-600">Manage all system users, roles, and permissions across the platform.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl p-6 card-shadow transition-transform duration-200 hover:-translate-y-1.5">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-1a6 6 0 00-9-5.197M9 20H4v-1a6 6 0 019-5.197M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalMahasiswa }}</p>
                            <p class="text-sm text-gray-600">Total Mahasiswa</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow transition-transform duration-200 hover:-translate-y-1.5">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalActiveUsers }}</p>
                            <p class="text-sm text-gray-600">Active Users</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow transition-transform duration-200 hover:-translate-y-1.5">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalInactiveUsers }}</p>
                            <p class="text-sm text-gray-600">Inactive Users</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow transition-transform duration-200 hover:-translate-y-1.5">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" />
                                <line x1="8" y1="8" x2="16" y2="16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="16" y1="8" x2="8" y2="16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalSuspendedUsers }}</p>
                            <p class="text-sm text-gray-600">Suspended Users</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New User Button -->
            <div class="mb-8">
                <button onclick="openUserModal()"
                    class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-200 card-shadow">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New User
                    </div>
                </button>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow mb-6">
                <form method="GET" action="{{ route('super_admin.dashboard') }}">
                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                        <div class="flex flex-col sm:flex-row gap-4 flex-1">
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input type="text" placeholder="Search users..." name="search"
                                    value="{{ request('search') }}"
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 w-full sm:w-64">
                            </div>
                            <select name="role"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                <option value="">All Roles</option>
                                <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>Super
                                    Admin</option>
                                <option value="admin_jurusan" {{ request('role') == 'admin_jurusan' ? 'selected' : '' }}>
                                    Admin Jurusan</option>
                                <option value="kaprodi" {{ request('role') == 'kaprodi' ? 'selected' : '' }}>Kaprodi
                                </option>
                                <option value="kajur" {{ request('role') == 'kajur' ? 'selected' : '' }}>Kajur</option>
                                <option value="mahasiswa" {{ request('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa
                                </option>
                            </select>
                            <select name="status"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            <div class="flex gap-2">
                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    Filter
                                </button>
                                <a href="{{ route('super_admin.dashboard') }}" type="button"
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                                    Clear
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Users Table -->
            <div class="bg-white rounded-xl card-shadow overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h3 class="text-lg font-semibold text-red-900">System Users</h3>
                    <p class="text-sm text-red-700 mt-1">Manage user accounts, roles, and permissions</p>
                </div>

                <!-- Desktop Table -->
                <div class="desktop-table overflow-x-auto w-full">
                    <table class="min-w-full w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox"
                                        class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Last Login</th> --}}
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($users as $u)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox"
                                            class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-purple-600 font-semibold text-sm">
                                                    {{ collect(explode(' ', $u->name))->map(fn($word) => strtoupper(Str::substr($word, 0, 1)))->implode('') }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $u->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $u->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select
                                            onchange="handleRoleChange(this, {{ $u->id }}, '{{ $u->role }}')"
                                            class="role-dropdown text-sm px-3 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white">
                                            <option value="super_admin" {{ $u->role == 'super_admin' ? 'selected' : '' }}>
                                                Super Admin</option>
                                            <option value="admin_jurusan"
                                                {{ $u->role == 'admin_jurusan' ? 'selected' : '' }}>Admin Jurusan
                                            </option>
                                            <option value="kaprodi" {{ $u->role == 'kaprodi' ? 'selected' : '' }}>
                                                Kaprodi</option>
                                            <option value="kajur" {{ $u->role == 'kajur' ? 'selected' : '' }}>Kajur
                                            </option>
                                            <option value="mahasiswa" {{ $u->role == 'mahasiswa' ? 'selected' : '' }}>
                                                Mahasiswa</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="status-active px-2 py-1 rounded-full text-xs font-medium">{{ $u->status == 'active' ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 20, 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button onclick="openEditUserModal('{{ $u->id }}')"
                                            class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">Edit</button>
                                        <button
                                            onclick="openDeleteModal('{{ route('super_admin.delete_user', $u->id) }}')"
                                            class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg transition-colors">Delete</button>
                                        @if ($u->is_suspend)
                                            {{-- Form untuk mengaktifkan kembali (Unsuspend) --}}
                                            <form action="{{ route('super_admin.toggle_suspend', $u->id) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="is_suspend" value="0">
                                                {{-- Kirim 0 untuk Unsuspend --}}
                                                <button type="submit"
                                                    class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-lg transition-colors">
                                                    Unsuspend
                                                </button>
                                            </form>
                                        @else
                                            {{-- Form untuk menangguhkan (Suspend) --}}
                                            <form action="{{ route('super_admin.toggle_suspend', $u->id) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="is_suspend" value="1">
                                                {{-- Kirim 1 untuk Suspend --}}
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg transition-colors">
                                                    Suspend
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No users found.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards -->
                <div class="mobile-cards p-4 space-y-4">
                    @forelse ($users as $u)
                        <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center">
                                    <input type="checkbox"
                                        class="rounded border-gray-300 text-red-600 focus:ring-red-500 mr-3">
                                    <div
                                        class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-purple-600 font-semibold text-sm">
                                            {{ collect(explode(' ', $u->name))->map(fn($word) => strtoupper(Str::substr($word, 0, 1)))->implode('') }}
                                        </span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $u->name }}</div>
                                        <div class="text-xs text-gray-500">{{ '@' . (Str::slug($u->name, '') ?? '') }}
                                        </div>
                                    </div>
                                </div>
                                <span class="status-active px-2 py-1 rounded-full text-xs font-medium">
                                    {{ $u->status == 'active' ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="space-y-2 text-sm mb-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Email:</span>
                                    <span class="text-gray-900 font-medium">{{ $u->email }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Role:</span>
                                    <select onchange="handleRoleChange(this, {{ $u->id }}, '{{ $u->role }}')"
                                        class="role-dropdown text-xs px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 bg-white">
                                        <option value="super_admin" {{ $u->role == 'super_admin' ? 'selected' : '' }}>
                                            Super Admin</option>
                                        <option value="admin_jurusan" {{ $u->role == 'admin_jurusan' ? 'selected' : '' }}>
                                            Admin Jurusan</option>
                                        <option value="kaprodi" {{ $u->role == 'kaprodi' ? 'selected' : '' }}>
                                            Kaprodi</option>
                                        <option value="kajur" {{ $u->role == 'kajur' ? 'selected' : '' }}>
                                            Kajur</option>
                                        <option value="mahasiswa" {{ $u->role == 'mahasiswa' ? 'selected' : '' }}>
                                            Mahasiswa</option>
                                    </select>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Last Login:</span>
                                    <span class="text-gray-900">Dec 20, 2023</span>
                                </div>
                            </div>
                            <div class="flex space-x-3">
                                <button onclick="openEditUserModal('{{ $u->id }}')"
                                    class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Edit</button>
                                <button onclick="openDeleteModal('{{ route('super_admin.delete_user', $u->id) }}')"
                                    class="flex-1 text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Delete</button>
                                @if ($u->is_suspend)
                                    <form action="{{ route('super_admin.toggle_suspend', $u->id) }}" method="POST"
                                        class="flex-1 inline-block m-0 p-0">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="is_suspend" value="0">
                                        <button type="submit"
                                            class="w-full text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                                            Unsuspend
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('super_admin.toggle_suspend', $u->id) }}" method="POST"
                                        class="flex-1 inline-block m-0 p-0">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="is_suspend" value="1">
                                        <button type="submit"
                                            class="w-full text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                                            Suspend
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">No users found.</div>
                    @endforelse
                </div>

                <!-- Pagination -->
                {{-- <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span
                                class="font-medium">1,247</span> results
                        </div>
                        <div class="flex space-x-2">
                            <button
                                class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50"
                                disabled>Previous</button>
                            <button
                                class="px-3 py-1 text-sm text-white bg-red-600 border border-red-600 rounded-lg">1</button>
                            <button
                                class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                            <button
                                class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                            <button
                                class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Next</button>
                        </div>
                    </div>
                </div> --}}
                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">

                    {{-- Cek jika ada data untuk ditampilkan --}}
                    @if ($users->hasPages())
                        <div class="flex items-center justify-between">

                            {{-- Teks "Showing..." yang dinamis --}}
                            <div class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium">{{ $users->firstItem() }}</span>
                                to
                                <span class="font-medium">{{ $users->lastItem() }}</span>
                                of
                                <span class="font-medium">{{ $users->total() }}</span>
                                results
                            </div>

                            {{-- Link paginasi dinamis dari Laravel --}}
                            <div>
                                {{ $users->links() }}
                            </div>

                        </div>
                    @endif

                </div>
            </div>
        </main>
    </div>

    <!-- Add Modal -->
    <x-admin.super.add-modal />

    {{-- Edit user modal --}}
    <x-admin.super.edit-modal />

    {{-- Delete User Modal --}}
    <x-admin.super.confirm-delete-modal />
@endsection
<script>
    // Role change handler
    async function handleRoleChange(selectElement, userId, oldRole) {
        const newRole = selectElement.value;

        try {
            // Kirim data ke server menggunakan Fetch API
            const response = await fetch(`/dashboard/users/${userId}/update-role`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                // Kirim data dalam format JSON
                body: JSON.stringify({
                    role: newRole
                })
            });

            const result = await response.json();

            if (response.ok) {
                // Jika berhasil, tampilkan notifikasi sukses
                showSuccessMessage(result.message, 'green');
            } else {
                // Jika gagal, tampilkan pesan error dan kembalikan dropdown ke nilai semula
                showSuccessMessage(result.message || 'Update failed.', 'red');
                selectElement.value = oldRole; // Kembalikan ke role lama
            }

        } catch (error) {
            console.error('Role update error:', error);
            showSuccessMessage('Could not connect to the server.', 'red');
            selectElement.value = oldRole; // Kembalikan ke role lama
        }
    }
</script>
