@extends('layouts.dashboard.layout')
@section('title', 'Admin Jurusan | Template Surat')
@section('template-surat', 'active')

@section('content')
    <div class="lg:ml-64">
        <!-- Top Bar -->
        <x-dashboard.topbar :title="'Dashboard'" />

        <!-- Dashboard Content -->
        <main class="p-4 sm:p-6">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Manajemen Template Surat</h2>
                <p class="text-gray-600">Buat, edit, dan kelola templat surat untuk departemen Anda.</p>
            </div>

            <!-- Add New Template Button -->
            <div class="mb-8">
                <button onclick="openTemplateModal()"
                    class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-200 card-shadow">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Template Surat Baru
                    </div>
                </button>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow mb-6">
                <form method="GET" action="{{ route('template-surat.index') }}"
                    class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                    <div class="flex flex-col sm:flex-row gap-4 flex-1">
                        <!-- Search -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="search" placeholder="Search templates..."
                                value="{{ request('search') }}"
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 w-full sm:w-64">
                        </div>

                        <!-- Filter kategori -->
                        <select name="kategori"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">Semua Kategori</option>
                            {{-- Loop untuk menampilkan data dari database --}}
                            @foreach ($letterTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ request('kategori') == $type->name ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Filter status -->
                        <select name="status"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived
                            </option>
                        </select>

                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Filter
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


            <!-- Templates Table -->
            <div class="bg-white rounded-xl card-shadow overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h3 class="text-lg font-semibold text-red-900">Template Surat</h3>
                    <p class="text-sm text-red-700 mt-1">Kelola dan atur templat surat departemen Anda</p>
                </div>

                <!-- Desktop Table -->
                <div class="desktop-table overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Surat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Terakhir diubah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Penggunaan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($templates as $template)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $template->nama_surat }}</div>
                                                <div class="text-sm text-gray-500">
                                                    {{ Str::limit(strip_tags($template->konten), 40) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ ucfirst($template->letterType->name) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $template->updated_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-medium
                    {{ $template->status === 'active' ? 'status-active' : ($template->status === 'draft' ? 'status-draft' : 'status-archived') }}">
                                            {{ ucfirst($template->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $template->letter_requests_count }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button onclick="editTemplate({{ $template }})"
                                            class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">
                                            Edit
                                        </button>

                                        <button
                                            onclick="duplicateTemplate({{ $template->id }}, '{{ $template->nama_surat }}')"
                                            class="text-blue-600 hover:text-blue-900 ml-2">
                                            Duplikat
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Belum ada template surat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards -->
                <div class="mobile-cards p-4 space-y-4">
                    @forelse($templates as $template)
                        <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $template->nama_surat }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ ucfirst($template->letter_type_id) }}
                                        </div>
                                    </div>
                                </div>
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-medium
                    {{ $template->status === 'active' ? 'status-active' : ($template->status === 'draft' ? 'status-draft' : 'status-archived') }}">
                                    {{ ucfirst($template->status) }}
                                </span>
                            </div>
                            <div class="space-y-2 text-sm mb-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Kategori:</span>
                                    <span class="text-gray-900 font-medium">{{ ucfirst($template->kategori) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Terakhir Diubah:</span>
                                    <span class="text-gray-900">{{ $template->updated_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Penggunaan:</span>
                                    <span class="text-gray-900">{{ $template->letter_requests_count }} times</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="editTemplate({{ $template }})"
                                    class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">
                                    Edit
                                </button>

                                <button onclick="duplicateTemplate({{ $template->id }}, '{{ $template->nama_surat }}')"
                                    class="text-blue-600 hover:text-blue-900 ml-2">
                                    Duplikat
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Belum ada template surat.</p>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Menampilkan
                            <span class="font-medium">{{ $templates->firstItem() }}</span>
                            hingga
                            <span class="font-medium">{{ $templates->lastItem() }}</span>
                            dari
                            <span class="font-medium">{{ $templates->total() }}</span>
                            hasil
                        </div>
                        <div>
                            {{ $templates->appends(request()->query())->links('pagination::tailwind') }}

                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <x-admin.jurusan.add-update-modal :letterTypes="$letterTypes" :users="$users" />

    @push('scriptsSurat')
        <script>
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            document.querySelector('form').onsubmit = function() {
                document.querySelector('#isi_konten').value = quill.root.innerHTML;
            };
        </script>

        <script>
            menuButton.addEventListener('click', openSidebar);
            closeSidebar.addEventListener('click', closeSidebarFunc);
            mobileOverlay.addEventListener('click', closeSidebarFunc);

            // Template modal functionality
            function openTemplateModal(template = null) {
                const modal = document.getElementById('template-modal');
                const modalTitle = document.getElementById('modal-title');
                const submitText = document.getElementById('submit-text');
                const form = document.querySelector('#template-modal form');

                if (template) {
                    // mode edit
                    modalTitle.textContent = `Edit Template: ${template.nama_surat}`;
                    submitText.textContent = 'Update Template';

                    // isi form sesuai data template
                    document.getElementById('template-name').value = template.nama_surat;
                    document.getElementById('template-category').value = template.letter_type_id;
                    document.getElementById('kode_seri').value = template.kode_seri;
                    document.getElementById('kode_unit').value = template.kode_unit;
                    document.getElementById('kode_arsip').value = template.kode_arsip;
                    document.getElementById('perihal').value = template.perihal;
                    document.getElementById('tujuan_nama').value = template.tujuan_nama;
                    document.getElementById('tujuan_tempat').value = template.tujuan_lokasi;
                    document.getElementById('isi_konten').value = template.konten;
                    document.getElementById('template-status').value = (template.status ?? '').toLowerCase();

                    const ara = document.getElementById('forward_to').value = template.forward_to;
                    quill.root.innerHTML = template.konten ?? '';

                    // ubah form action ke route update
                    form.action = `/template-surat/${template.id}`;
                    form.insertAdjacentHTML("beforeend", `<input type="hidden" name="_method" value="PUT">`);
                } else {
                    // mode create
                    modalTitle.textContent = 'Buat Template Surat Baru';
                    submitText.textContent = 'Buat Template';
                    form.action = `{{ route('template-surat.store') }}`;
                    form.reset();
                }

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }


            function closeTemplateModal() {
                document.getElementById('template-modal').classList.add('hidden');
                document.getElementById('template-modal').classList.remove('flex');
                // Reset form
                document.querySelector('#template-modal form').reset();
            }

            // Action functions
            function editTemplate(template) {
                openTemplateModal(template);
            }


            function duplicateTemplate(templateId, templateName) {
                // Buat form dinamis untuk mengirim POST request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/template-surat/${templateId}/duplicate`;

                // Tambahkan CSRF token untuk keamanan
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                form.appendChild(csrfToken);
                document.body.appendChild(form);

                // Tampilkan konfirmasi
                if (confirm(`Apakah Anda yakin ingin menduplikasi template "${templateName}"?`)) {
                    form.submit();
                }
            }

            // Close modals when clicking outside
            document.getElementById('template-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeTemplateModal();
                }
            });
        </script>
    @endpush
@endsection
