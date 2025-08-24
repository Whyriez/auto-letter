@extends('layouts.dashboard.layout')
@section('title', 'Admin Jurusan | Surat')
@section('surat', 'active')

@section('content')
    <div class="lg:ml-64">
        <x-dashboard.topbar :title="'Dashboard'" />

        <main class="p-4 sm:p-6">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Manajemen Surat</h2>
                <p class="text-gray-600">Buat, edit, dan kelola templat surat untuk departemen Anda.</p>
            </div>

            <div class="mb-8">
                <button onclick="openTemplateModal()"
                    class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-200 card-shadow">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Surat Baru
                    </div>
                </button>
            </div>

            <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow mb-6">
                <form method="GET" action="{{ route('surat.index') }}"
                    class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                    <div class="flex flex-col sm:flex-row gap-4 flex-1">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="search" placeholder="Search surat..."
                                value="{{ request('search') }}"
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 w-full sm:w-64">
                        </div>

                        <select name="kategori"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">Semua Kategori</option>
                            @foreach ($letterTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ request('kategori') == $type->name ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>

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


            <div class="bg-white rounded-xl card-shadow overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h3 class="text-lg font-semibold text-red-900">Template Surat</h3>
                    <p class="text-sm text-red-700 mt-1">Kelola dan atur templat surat departemen Anda</p>
                </div>

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
                            @forelse($surats as $surat)
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
                                                    {{ $surat->nama_surat }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ ucfirst($surat->letterType->name) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $surat->updated_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-medium
                    {{ $surat->status === 'active' ? 'status-active' : ($surat->status === 'draft' ? 'status-draft' : 'status-archived') }}">
                                            {{ ucfirst($surat->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $surat->letter_requests_count }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button onclick="editTemplate({{ $surat }})"
                                            class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">
                                            Edit
                                        </button>

                                        <button
                                            onclick="duplicateTemplate({{ $surat->id }}, '{{ $surat->nama_surat }}')"
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

                <div class="mobile-cards p-4 space-y-4">
                    @forelse($surats as $surat)
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
                                        <div class="text-sm font-medium text-gray-900">{{ $surat->nama_surat }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ ucfirst($surat->letter_type_id) }}
                                        </div>
                                    </div>
                                </div>
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-medium
                    {{ $surat->status === 'active' ? 'status-active' : ($surat->status === 'draft' ? 'status-draft' : 'status-archived') }}">
                                    {{ ucfirst($surat->status) }}
                                </span>
                            </div>
                            <div class="space-y-2 text-sm mb-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Kategori:</span>
                                    <span class="text-gray-900 font-medium">{{ ucfirst($surat->kategori) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Terakhir Diubah:</span>
                                    <span class="text-gray-900">{{ $surat->updated_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Penggunaan:</span>
                                    <span class="text-gray-900">{{ $surat->letter_requests_count }} times</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="editTemplate({{ $surat }})"
                                    class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">
                                    Edit
                                </button>

                                <button onclick="duplicateTemplate({{ $surat->id }}, '{{ $surat->nama_surat }}')"
                                    class="text-blue-600 hover:text-blue-900 ml-2">
                                    Duplikat
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Belum ada surat.</p>
                    @endforelse
                </div>

                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                    @if ($surats->hasPages())
                        {{ $surats->links('components.paging.custom-pagination') }}
                    @endif
                </div>

            </div>
        </main>
    </div>

    <x-admin.jurusan.add-update-modal :letterTypes="$letterTypes" :users="$users" />
    <x-admin.jurusan.confirm-duplicate-modal />

    @push('scriptsSurat')
        @verbatim
            <script>
                const placeholders = [{
                        key: 'SPASI_PENYELARAS',
                        display: '{{ SPASI_PENYELARAS }}',
                        description: 'Untuk menyelaraskan teks seperti tabel'
                    },
                    {
                        key: 'nama_mahasiswa',
                        display: '{{ NAMA_MAHASISWA }}',
                        description: 'Nama Mahasiswa Utama'
                    },
                    {
                        key: 'nim',
                        display: '{{ NIM }}',
                        description: 'NIM Mahasiswa Utama'
                    },
                    {
                        key: 'nama_dosen',
                        display: '{{ NAMA_DOSEN }}',
                        description: 'Nama Penanda Tangan (Dosen)'
                    },
                    {
                        key: 'nip',
                        display: '{{ NIP }}',
                        description: 'NIP Penanda Tangan (Dosen)'
                    },
                    {
                        key: 'jabatan',
                        display: '{{ JABATAN }}',
                        description: 'Jabatan Penanda Tangan (Dosen)'
                    },
                    {
                        key: 'lokasi',
                        display: '{{ LOKASI }}',
                        description: 'Lokasi Tujuan'
                    },
                    {
                        key: 'waktu',
                        display: '{{ WAKTU }}',
                        description: 'Waktu (Hari, Bulan, Tanggal, Jam)'
                    },
                    {
                        key: 'mata_kuliah',
                        display: '{{ MATA_KULIAH }}',
                        description: 'Mata Kuliah'
                    },
                    {
                        key: 'daftar_mahasiswa',
                        display: '{{ DAFTAR_MAHASISWA }}',
                        description: 'Daftar Mahasiswa Tambahan'
                    }
                ];

                const TRIGGER_CHARS = '{' + '{';
                const TRIGGER_LENGTH = 2;

                const quill = new Quill('#editor', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            [{
                                'header': [1, 2, 3, 4, 5, 6, false]
                            }],
                            [{
                                'font': []
                            }],
                            [{
                                'align': []
                            }],
                            ['clean']
                        ]
                    }
                });

                const dropdown = document.createElement('div');
                dropdown.className = 'autosuggest-dropdown';
                dropdown.style.cssText = `
        position: absolute;
        background: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
        min-width: 300px;
    `;
                document.body.appendChild(dropdown);

                let currentRange = null;
                let isDropdownVisible = false;
                let selectedIndex = -1;
                let filteredSuggestions = [];

                function showDropdown(suggestions, bounds) {
                    filteredSuggestions = suggestions;
                    dropdown.innerHTML = '';
                    dropdown.style.display = 'block';

                    suggestions.forEach((item, index) => {
                        const div = document.createElement('div');
                        div.className = 'suggestion-item';
                        div.style.cssText = `
                padding: 8px 12px;
                cursor: pointer;
                border-bottom: 1px solid #f0f0f0;
                transition: background-color 0.2s;
            `;

                        div.innerHTML = `
                <div style="font-family: monospace; color: #e74c3c; font-weight: bold;">${item.display}</div>
                <div style="font-size: 12px; color: #666; margin-top: 2px;">${item.description}</div>
            `;

                        div.addEventListener('mouseenter', () => {
                            clearSelection();
                            div.style.backgroundColor = '#f8f9fa';
                            selectedIndex = index;
                        });

                        div.addEventListener('mouseleave', () => {
                            div.style.backgroundColor = '';
                        });

                        div.addEventListener('click', () => {
                            insertPlaceholder(item.display);
                        });

                        dropdown.appendChild(div);
                    });

                    const editorBounds = quill.container.getBoundingClientRect();
                    dropdown.style.left = (editorBounds.left + bounds.left) + 'px';
                    dropdown.style.top = (editorBounds.top + bounds.bottom + 5) + 'px';

                    isDropdownVisible = true;
                    selectedIndex = -1;
                }

                function hideDropdown() {
                    dropdown.style.display = 'none';
                    isDropdownVisible = false;
                    selectedIndex = -1;
                    filteredSuggestions = [];
                }

                function clearSelection() {
                    const items = dropdown.querySelectorAll('.suggestion-item');
                    items.forEach(item => {
                        item.style.backgroundColor = '';
                    });
                }

                function highlightSelection() {
                    clearSelection();
                    const items = dropdown.querySelectorAll('.suggestion-item');
                    if (selectedIndex >= 0 && selectedIndex < items.length) {
                        items[selectedIndex].style.backgroundColor = '#e3f2fd';
                    }
                }

                function insertPlaceholder(placeholder) {
                    if (currentRange) {
                        const selection = quill.getSelection();
                        const currentPos = selection ? selection.index : currentRange.index;
                        const text = quill.getText();

                        let searchStart = Math.max(0, currentPos - 20);
                        const textBefore = text.substring(searchStart, currentPos);
                        const braceIndex = textBefore.lastIndexOf(TRIGGER_CHARS);

                        if (braceIndex !== -1) {
                            const actualBracePos = searchStart + braceIndex;
                            const deleteLength = currentPos - actualBracePos;

                            quill.deleteText(actualBracePos, deleteLength);
                            quill.insertText(actualBracePos, placeholder);
                            quill.setSelection(actualBracePos + placeholder.length);
                        }
                    }
                    hideDropdown();
                    quill.focus();
                }

                const textChangeHandler = function() {
                    const selection = quill.getSelection();
                    if (!selection) return;

                    const text = quill.getText();
                    const currentPos = selection.index;

                    let searchStart = Math.max(0, currentPos - 20);
                    const textBefore = text.substring(searchStart, currentPos);

                    const braceIndex = textBefore.lastIndexOf(TRIGGER_CHARS);

                    if (braceIndex !== -1) {
                        const actualBracePos = searchStart + braceIndex;
                        const query = text.substring(actualBracePos + TRIGGER_LENGTH, currentPos).toLowerCase();

                        const filtered = placeholders.filter(item =>
                            item.key.toLowerCase().includes(query) ||
                            item.description.toLowerCase().includes(query)
                        );

                        if (filtered.length > 0) {
                            currentRange = {
                                index: currentPos
                            };
                            const bounds = quill.getBounds(currentPos);
                            showDropdown(filtered, bounds);
                            return;
                        }
                    }

                    hideDropdown();
                };

                const selectionChangeHandler = function(range) {
                    if (!range) {
                        hideDropdown();
                    }
                };

                quill.on('text-change', textChangeHandler);
                quill.on('selection-change', selectionChangeHandler);

                quill.root.addEventListener('keydown', function(e) {
                    if (!isDropdownVisible) return;

                    switch (e.key) {
                        case 'ArrowDown':
                            e.preventDefault();
                            const itemsDown = dropdown.querySelectorAll('.suggestion-item');
                            selectedIndex = Math.min(selectedIndex + 1, itemsDown.length - 1);
                            highlightSelection();
                            break;

                        case 'ArrowUp':
                            e.preventDefault();
                            selectedIndex = Math.max(selectedIndex - 1, -1);
                            highlightSelection();
                            break;

                        case 'Enter':
                            e.preventDefault();
                            e.stopPropagation();
                            if (filteredSuggestions.length > 0) {
                                const indexToUse = selectedIndex >= 0 ? selectedIndex : 0;
                                const placeholder = filteredSuggestions[indexToUse].display;
                                insertPlaceholder(placeholder);
                            }
                            break;

                        case 'Escape':
                            e.preventDefault();
                            hideDropdown();
                            break;
                    }
                });

                quill.keyboard.addBinding({
                    key: 'ArrowDown'
                }, function(range, context) {
                    if (isDropdownVisible) {
                        return false;
                    }
                    return true;
                });

                quill.keyboard.addBinding({
                    key: 'ArrowUp'
                }, function(range, context) {
                    if (isDropdownVisible) {
                        return false;
                    }
                    return true;
                });

                quill.keyboard.addBinding({
                    key: 'Enter'
                }, function(range, context) {
                    if (isDropdownVisible) {
                        return false;
                    }
                    return true;
                });

                quill.keyboard.addBinding({
                    key: 'Escape'
                }, function(range, context) {
                    if (isDropdownVisible) {
                        return false;
                    }
                    return true;
                });

                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target) && !quill.container.contains(e.target)) {
                        hideDropdown();
                    }
                });

                document.querySelector('form').onsubmit = function() {
                    document.querySelector('#isi_konten').value = quill.root.innerHTML;
                };
            </script>

        @endverbatim

        <script>
            function openTemplateModal(template = null) {
                const modal = document.getElementById('template-modal');
                const modalTitle = document.getElementById('modal-title');
                const submitText = document.getElementById('submit-text');
                const form = document.querySelector('#template-modal form');

                if (template) {
                    modalTitle.textContent = `Edit Template: ${template.nama_surat}`;
                    submitText.textContent = 'Update Template';

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

                    form.action = `/surat/${template.id}`;
                    form.insertAdjacentHTML("beforeend", `<input type="hidden" name="_method" value="PUT">`);
                } else {
                    modalTitle.textContent = 'Buat Template Surat Baru';
                    submitText.textContent = 'Buat Template';
                    form.action = `{{ route('surat.store') }}`;
                    form.reset();
                }

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }


            function closeTemplateModal() {
                document.getElementById('template-modal').classList.add('hidden');
                document.getElementById('template-modal').classList.remove('flex');
                document.querySelector('#template-modal form').reset();
            }

            function editTemplate(template) {
                openTemplateModal(template);
            }


            function duplicateTemplate(templateId, templateName) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/surat/${templateId}/duplicate`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                form.appendChild(csrfToken);
                document.body.appendChild(form);

                if (confirm(`Apakah Anda yakin ingin menduplikasi template "${templateName}"?`)) {
                    form.submit();
                }
            }

            document.getElementById('template-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeTemplateModal();
                }
            });
        </script>
    @endpush

@endsection
