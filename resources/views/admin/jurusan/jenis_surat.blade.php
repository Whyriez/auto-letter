@extends('layouts.dashboard.layout')
@section('title', 'Admin Jurusan | Jenis Surat')
@section('jenis-surat', 'active')

@section('content')
    <div class="lg:ml-64">
        <!-- Top Bar -->
        <x-dashboard.topbar :title="'Dashboard'" />

        <!-- Dashboard Content -->
        <main class="p-4 sm:p-6">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Manajemen Jenis Surat</h2>
                <p class="text-gray-600">Kelola jenis-jenis surat yang ada di sistem Anda.</p>
            </div>

            <div class="mb-8">
                <button onclick="openLetterTypeModal()"
                    class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-200 card-shadow">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Jenis Surat Baru
                    </div>
                </button>
            </div>

            <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow mb-6">
                <form method="GET" action="{{ route('jenis-surat.index') }}"
                    class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                    <div class="flex flex-col sm:flex-row gap-4 flex-1">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="search" placeholder="Cari jenis surat..."
                                value="{{ request('search') }}"
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 w-full sm:w-64">
                        </div>
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                    <p class="font-semibold mb-2">⚠️ Ada kesalahan input:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-xl card-shadow overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h3 class="text-lg font-semibold text-red-900">Daftar Jenis Surat</h3>
                    <p class="text-sm text-red-700 mt-1">Kelola dan atur jenis-jenis surat yang tersedia.</p>
                </div>

                <div class="desktop-table overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Jenis Surat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Terakhir Diubah
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($letterTypes as $type)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $type->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $type->updated_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button onclick="openLetterTypeModal({{ json_encode($type) }})"
                                            class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">
                                            Edit
                                        </button>
                                        <form action="{{ route('jenis-surat.destroy', $type->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis surat ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Belum ada jenis surat yang dibuat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Menampilkan
                            <span class="font-medium">{{ $letterTypes->firstItem() }}</span>
                            hingga
                            <span class="font-medium">{{ $letterTypes->lastItem() }}</span>
                            dari
                            <span class="font-medium">{{ $letterTypes->total() }}</span>
                            hasil
                        </div>
                        <div>
                            {{ $letterTypes->appends(request()->query())->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="letter-type-modal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[90vh] flex flex-col overflow-hidden">

            <div class="flex items-center justify-between p-6 border-b border-gray-200 flex-shrink-0">
                <h2 id="modal-title" class="text-xl font-semibold text-gray-900">Buat Jenis Surat Baru</h2>
                <button onclick="closeLetterTypeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <form id="letter-type-form" method="POST" action="{{ route('jenis-surat.store') }}"
                class="flex-1 flex flex-col overflow-hidden">
                @csrf
                <div class="flex-1 overflow-y-auto p-6 space-y-6">

                    <div>
                        <label for="type-name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Jenis Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="type-name" name="name" required
                            placeholder="Contoh: Surat Keterangan Aktif Kuliah"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-900 placeholder-gray-500">
                    </div>

                </div>

                <div class="flex flex-col sm:flex-row gap-3 p-6 border-t border-gray-200 flex-shrink-0 bg-white">
                    <button type="button" onclick="closeLetterTypeModal()"
                        class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-200">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-200">
                        <span id="submit-text">Simpan Jenis Surat</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scriptsSurat')
        <script>
            function openLetterTypeModal(letterType = null) {
                const modal = document.getElementById('letter-type-modal');
                const form = document.getElementById('letter-type-form');
                const modalTitle = document.querySelector('#letter-type-modal #modal-title');
                const submitText = document.querySelector('#letter-type-modal #submit-text');

                // Reset form
                form.reset();
                form.querySelector('input[name="_method"]')?.remove();
                form.action = "{{ route('jenis-surat.store') }}";

                if (letterType) {
                    // Mode edit
                    modalTitle.textContent = 'Edit Jenis Surat';
                    submitText.textContent = 'Update Jenis Surat';
                    const updateUrl = `{{ route('jenis-surat.update', ['jenis_surat' => ':id']) }}`.replace(':id', letterType
                        .id);
                    form.action = updateUrl;
                    form.insertAdjacentHTML("beforeend", `<input type="hidden" name="_method" value="PUT">`);

                    // Isi form dengan data yang ada
                    document.getElementById('type-name').value = letterType.name;
                } else {
                    // Mode create
                    modalTitle.textContent = 'Buat Jenis Surat Baru';
                    submitText.textContent = 'Simpan Jenis Surat';
                }

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            // Aksi untuk menutup modal Jenis Surat
            function closeLetterTypeModal() {
                const modal = document.getElementById('letter-type-modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            // Event listener untuk menutup modal saat klik di luar
            document.getElementById('letter-type-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeLetterTypeModal();
                }
            });

            // Action functions
            function editTemplate(template) {
                openTemplateModal(template);
            }
        </script>
    @endpush
@endsection
