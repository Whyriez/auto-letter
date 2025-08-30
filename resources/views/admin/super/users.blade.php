@extends('layouts.dashboard.layout')
@section('title', 'Super Admin | User Management')
@section('users', 'active')

@section('content')
    <div class="lg:ml-64">
        <x-dashboard.topbar :title="'Manajemen Pengguna'" />

        <main class="p-4 sm:p-6">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Manajemen Pengguna Sistem</h2>
                <p class="text-gray-600">Kelola semua pengguna sistem, peran, dan izin di seluruh platform.</p>
            </div>

            <div class="mb-8 flex items-center flex-col sm:flex-row gap-4">
                <button onclick="openUserModal()"
                    class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-200 card-shadow">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah User Baru
                    </div>
                </button>
                <!-- Button: Import Mahasiswa (lebih proporsional + ikon upload yang relevan) -->
                <button type="button" onclick="openImportUsersModal()" title="Import file CSV/Excel mahasiswa"
                    aria-label="Import data mahasiswa (CSV/Excel)"
                    class="group w-full sm:w-auto inline-flex items-center justify-center gap-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 md:px-7 md:py-3.5 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-200 card-shadow">
                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        aria-hidden="true">
                        <!-- Tray (baki) -->
                        <path d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <!-- Panah ke atas -->
                        <path d="M7.5 10.5 12 6m0 0 4.5 4.5M12 6v12" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                    <span class="text-sm md:text-base tracking-tight">
                        Impor Mahasiswa
                    </span>
                </button>

            </div>

            <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow mb-6">
                <form method="GET" action="{{ route('super_admin.users') }}">
                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                        <div class="flex flex-col sm:flex-row gap-4 flex-1">
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input type="text" placeholder="cari pengguna..." name="search"
                                    value="{{ request('search') }}"
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 w-full sm:w-64">
                            </div>
                            <select name="role"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                <option value="">Semua Peran</option>
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
                                <option value="">Semua Status</option>
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
                                <a href="{{ route('super_admin.users') }}" type="button"
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl card-shadow overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h3 class="text-lg font-semibold text-red-900">Pengguna Sistem</h3>
                    <p class="text-sm text-red-700 mt-1">Mengelola akun pengguna, peran, dan izin</p>
                </div>

                <div class="desktop-table overflow-x-auto w-full">
                    <table class="min-w-max w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIM/NIP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Program Studi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jurusan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($users as $u)
                                <tr class="hover:bg-gray-50">
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $u->nim_nip ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $u->prodi ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $u->jurusan ?? '-' }}
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
                                            class="status-active px-2 py-1 rounded-full text-xs font-medium">{{ $u->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button onclick="openEditUserModal('{{ $u->id }}')"
                                            class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">Edit</button>
                                        <button
                                            onclick="openDeleteModal('{{ route('super_admin.delete_user', $u->id) }}')"
                                            class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg transition-colors">Hapus</button>
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
                                    <td colspan="9" class="text-center py-4 text-gray-500">Belum ada user</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

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
                                    {{ $u->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
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
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">NIM/NIP:</span>
                                    <span class="text-gray-900 font-medium">{{ $u->nim_nip ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Prodi:</span>
                                    <span class="text-gray-900 font-medium">{{ $u->prodi ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Jurusan:</span>
                                    <span class="text-gray-900 font-medium">{{ $u->jurusan ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="flex space-x-3">
                                <button onclick="openEditUserModal('{{ $u->id }}')"
                                    class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Edit</button>
                                <button onclick="openDeleteModal('{{ route('super_admin.delete_user', $u->id) }}')"
                                    class="flex-1 text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hapus</button>
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

                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">

                    @if ($users->hasPages())
                        {{ $users->links('components.paging.custom-pagination') }}
                    @endif

                </div>
            </div>
        </main>
    </div>

    <x-admin.super.add-modal />

    <x-admin.super.edit-modal />

    <x-admin.super.confirm-delete-modal />

    <x-admin.super.upload-csv-user-modal />

@endsection
<script>
    async function handleRoleChange(selectElement, userId, oldRole) {
        const newRole = selectElement.value;

        try {
            const response = await fetch(`/dashboard/users/${userId}/update-role`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    role: newRole
                })
            });

            const result = await response.json();

            if (response.ok) {
                showSuccessMessage(result.message, 'green');
            } else {
                showSuccessMessage(result.message || 'Gagal mengupdate.', 'red');
                selectElement.value = oldRole;
            }

        } catch (error) {
            console.error('Kesalahan saat mengupdate role:', error);
            showSuccessMessage('Tidak dapat terhubung ke server.', 'red');
            selectElement.value = oldRole;
        }
    }
</script>
