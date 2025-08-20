@extends('layouts.dashboard.layout')
@section('title', 'Mahasiswa | Dashboard')
@section('mahasiswa-dashboard', 'active')



@section('content')
    <div class="lg:ml-64">
        <x-dashboard.topbar :title="'Dashboard'" />

        <main class="p-4 sm:p-6">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang kembali, {{ Auth::user()->name }}</h2>
                <p class="text-gray-600">Kelola surat rekomendasi Anda dan lacak kemajuannya.</p>
            </div>

            <div class="mb-8">
                <button onclick="openLetterModal()"
                    class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-200 card-shadow">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Ajukan Surat Baru
                    </div>
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                <a href="#" class="bg-white rounded-xl p-6 card-shadow transition-transform duration-200 card-hover">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalLetters }}</p>
                            <p class="text-sm text-gray-600">Total Surat</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="bg-white rounded-xl p-6 card-shadow transition-transform duration-200 card-hover">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $pendingLetters }}</p>
                            <p class="text-sm text-gray-600">Menunggu</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="bg-white rounded-xl p-6 card-shadow transition-transform duration-200 card-hover">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $approvedLetters }}</p>
                            <p class="text-sm text-gray-600">Diterima</p>
                        </div>
                    </div>
                </a>
            </div>

            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Riwayat Surat Saya</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse ($letterHistory as $letter)
                        @php
                            $statusUI = [
                                'pending' => [
                                    'badge' => 'bg-amber-100 text-amber-800',
                                    'dot' => 'bg-amber-500',
                                    'label' => 'Menunggu',
                                ],
                                'rejected' => [
                                    'badge' => 'bg-red-100 text-red-800',
                                    'dot' => 'bg-red-500',
                                    'label' => 'Ditolak',
                                ],
                                'completed' => [
                                    'badge' => 'bg-green-100 text-green-800',
                                    'dot' => 'bg-green-600',
                                    'label' => 'Selesai',
                                ],
                            ];
                            $ui = $statusUI[$letter->status] ?? [
                                'badge' => 'bg-gray-100 text-gray-800',
                                'dot' => 'bg-gray-400',
                                'label' => ucfirst($letter->status),
                            ];
                        @endphp

                        @if ($letter->status === 'completed')
                            <a href="{{ Storage::url($letter->final_document_path) }}" target="_blank"
                                class="group block bg-white rounded-xl border border-gray-200 p-5 card-shadow hover:bg-gray-50 hover:border-gray-300 transition-colors card-hover no-underline">
                            @else
                                <div class="bg-white rounded-xl border border-gray-200 p-5 card-shadow">
                        @endif

                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <h4 class="font-semibold text-gray-900 truncate">
                                    {{ $letter->LetterTemplate->nama_surat ?? 'Jenis Surat Tidak Diketahui' }}
                                </h4>
                                @if (!empty($letter->notes))
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ $letter->notes }}
                                    </p>
                                @endif
                            </div>

                            <span
                                class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium {{ $ui['badge'] }}">
                                <span class="h-1.5 w-1.5 rounded-full {{ $ui['dot'] }}"></span>
                                {{ $ui['label'] }}
                            </span>
                        </div>

                        <div class="mt-4 space-y-2 text-sm">
                            <div class="flex items-center justify-between rounded-lg bg-gray-50 px-3 py-2">
                                <span class="text-gray-500">Diajukan</span>
                                <span class="font-medium text-gray-900">
                                    {{ optional($letter->created_at)->translatedFormat('d M Y') ?? '-' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-gray-50 px-3 py-2">
                                <span class="text-gray-500">Diperlukan</span>
                                <span class="font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($letter->needed_at)->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-gray-50 px-3 py-2">
                                <span class="text-gray-500">Kode</span>
                                <span class="font-mono text-gray-900">{{ $letter->unique_code }}</span>
                            </div>
                        </div>

                        @if ($letter->status === 'completed')
                            <div
                                class="mt-3 inline-flex items-center gap-1 text-xs text-gray-500 opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 17l10-10M17 7H7m10 0v10" />
                                </svg>
                                <span>Buka dokumen</span>
                            </div>
                        @endif

                        @if ($letter->status === 'completed')
                            </a>
                        @else
                </div>
                @endif

            @empty
                <div class="md:col-span-3 text-center py-12">
                    <p class="text-gray-500">Belum ada riwayat permintaan surat.</p>
                </div>
                @endforelse
            </div>
        </main>
    </div>

    <div id="letter-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[90vh] flex flex-col overflow-hidden">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-red-50 flex-shrink-0">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v12a2 2 0 01-2 2z" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Formulir Permintaan Surat</h2>
                        <p class="text-xs text-gray-600">Pilih jenis surat dan lengkapi detail permintaan.</p>
                    </div>
                </div>
                <button onclick="closeLetterModal()" class="text-gray-400 hover:text-gray-600" aria-label="Tutup">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="letter-form" class="flex-1 overflow-y-auto px-6 py-6 space-y-6"
                action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf

                <section class="bg-white rounded-xl border border-gray-200 p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5h12M9 12h12M9 19h12M4 6h.01M4 12h.01M4 18h.01" />
                        </svg>

                        <h3 class="text-sm font-semibold text-gray-900">Jenis Surat</h3>
                    </div>
                    <label for="letter-type" class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Jenis Surat <span class="text-red-500">*</span>
                    </label>
                    <select id="letter-type" name="letter-type" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-900">
                        <option value="">-- Pilih Jenis Surat --</option>
                        @foreach ($letterTypes as $type)
                            <option value="{{ $type->id }}" data-letter-type="{{ $type->letterType->name }}">
                                {{ $type->nama_surat }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-2">Jenis surat menentukan field tambahan yang perlu diisi.</p>
                </section>

                <section class="bg-gray-50 rounded-xl border border-gray-200 p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11c1.657 0 3-1.567 3-3.5S13.657 4 12 4 9 5.567 9 7.5 10.343 11 12 11zM5 21v-2a4 4 0 014-4h6a4 4 0 014 4v2" />
                        </svg>
                        <h3 class="text-sm font-semibold text-gray-900">Data Mahasiswa (Otomatis)</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="full-name" class="block text-sm font-medium text-gray-600 mb-1">Nama
                                Lengkap</label>
                            <input type="text" id="full-name" name="full-name" value="{{ Auth::user()->name }}"
                                readonly
                                class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                        </div>
                        <div>
                            <label for="nim" class="block text-sm font-medium text-gray-600 mb-1">NIM</label>
                            <input type="text" id="nim" name="nim" value="{{ Auth::user()->nim_nip }}"
                                readonly
                                class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                        </div>
                        <div>
                            <label for="program-study" class="block text-sm font-medium text-gray-600 mb-1">Program
                                Studi</label>
                            <input type="text" id="program-study" name="program-study"
                                value="{{ Auth::user()->prodi }}" readonly
                                class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                        </div>
                        <div>
                            <label for="jurusan" class="block text-sm font-medium text-gray-600 mb-1">Jurusan</label>
                            <input type="text" id="jurusan" name="jurusan" value="{{ Auth::user()->jurusan }}"
                                readonly
                                class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                        </div>
                    </div>
                </section>

                <section id="dynamic-fields-container" class="space-y-4"></section>
                <section id="research-fields-container" class="space-y-4 hidden">
                    <div id="location-fields-container" class="hidden">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi Tujuan</label>
                        <input type="text" id="location" name="location"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-900"
                            placeholder="Masukkan lokasi tujuan (contoh: di Jakarta)">
                    </div>
                    <div id="waktu-fields-container" class="hidden">
                        <label for="waktu" class="block text-sm font-medium text-gray-700 mb-1">Waktu</label>
                        <input type="text" id="waktu" name="waktu"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-900"
                            placeholder="Masukkan Waktu (contoh: 1 bulan, 1 hari, dst.)">
                    </div>
                    <div id="course-fields-container" class="hidden">
                        <label for="course" class="block text-sm font-medium text-gray-700 mb-1">Mata Kuliah</label>
                        <input type="text" id="course" name="course"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-900"
                            placeholder="Masukkan nama mata kuliah">
                    </div>
                </section>

                <section class="bg-white rounded-xl border border-gray-200 p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2
                                                       2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                        </svg>

                        <h3 class="text-sm font-semibold text-gray-900">Keperluan</h3>
                    </div>
                    <label for="purpose" class="block text-sm font-medium text-gray-700 mb-2">
                        Keperluan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="purpose" name="purpose" rows="3" required
                        placeholder="Jelaskan keperluan surat yang diminta..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-900 placeholder-gray-500 resize-none"></textarea>
                </section>

                <section class="bg-white rounded-xl border border-gray-200 p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"
                                stroke="currentColor" stroke-width="2" fill="none" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 2v4M8 2v4M3 10h18" />
                        </svg>

                        <h3 class="text-sm font-semibold text-gray-900">Tanggal Diperlukan</h3>
                    </div>
                    <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Diperlukan <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="deadline" name="deadline" required min="2024-01-01"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-900">
                    <p class="text-xs text-gray-500 mt-2">Pastikan tanggal realistis agar proses verifikasi & penerbitan
                        tidak terburu-buru.</p>
                </section>
            </form>

            <div class="flex flex-col sm:flex-row gap-3 px-6 py-4 border-t border-gray-200 bg-white flex-shrink-0">
                <button type="button" onclick="closeLetterModal()"
                    class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    Batal
                </button>
                <button type="submit" form="letter-form"
                    class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-red-200">
                    Kirim Permintaan
                </button>
            </div>

        </div>
    </div>


    @push('scriptsMahasiswa')
        <script>
            function openLetterModal() {
                document.getElementById('letter-modal').classList.remove('hidden');
                document.getElementById('letter-modal').classList.add('flex');
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('deadline').setAttribute('min', today);
            }

            function closeLetterModal() {
                document.getElementById('letter-modal').classList.add('hidden');
                document.getElementById('letter-modal').classList.remove('flex');
                document.querySelector('#letter-modal form').reset();
            }

            document.getElementById('letter-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeLetterModal();
                }
            });

            function createDynamicFields(index) {
                return `
    <div class="dynamic-group bg-gray-50 rounded-lg p-4 space-y-4 mb-4" data-index="${index}">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-medium text-gray-700">Mahasiswa Tambahan #${index}</h3>
            <button type="button" onclick="removeDynamicFields(this)" class="text-gray-400 hover:text-red-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div>
            <label for="additional-name-${index}" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" id="additional-name-${index}" name="additional_names[]" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-900"
                placeholder="Nama Lengkap">
        </div>
        <div>
            <label for="additional-nim-${index}" class="block text-sm font-medium text-gray-700 mb-1">NIM</label>
            <input type="text" id="additional-nim-${index}" name="additional_nims[]" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-900"
                placeholder="NIM">
        </div>
    </div>
    `;
            }

            function removeDynamicFields(button) {
                const group = button.closest('.dynamic-group');
                if (group) {
                    group.remove();
                    updateFieldNumbers();
                }
            }

            function updateFieldNumbers() {
                const containers = document.querySelectorAll('#dynamic-fields-container .dynamic-group');
                containers.forEach((container, index) => {
                    const newIndex = index + 1;
                    container.setAttribute('data-index', newIndex);
                    container.querySelector('h3').textContent = `Mahasiswa Tambahan #${newIndex}`;
                    container.querySelectorAll('label, input').forEach(el => {
                        const oldId = el.getAttribute('id');
                        const newId = oldId.replace(/-\d+$/, `-${newIndex}`);
                        el.setAttribute('id', newId);
                        if (el.tagName === 'LABEL') {
                            el.setAttribute('for', newId);
                        }
                    });
                });
            }

            document.getElementById('letter-type').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const selectedLetterType = selectedOption.dataset.letterType;

                const container = document.getElementById('dynamic-fields-container');
                const researchContainer = document.getElementById('research-fields-container');
                const locationContainer = document.getElementById('location-fields-container');
                const waktuContainer = document.getElementById('waktu-fields-container');
                const courseContainer = document.getElementById('course-fields-container');

                container.innerHTML = '';
                researchContainer.classList.add('hidden');
                locationContainer.classList.add('hidden');
                waktuContainer.classList.add('hidden');
                courseContainer.classList.add('hidden');

                if (selectedLetterType === 'Surat Rekomendasi' || selectedLetterType === 'Surat Izin Penelitian' ||
                    selectedLetterType === 'Surat Akademik') {
                    const addButton = document.createElement('button');
                    addButton.setAttribute('type', 'button');
                    addButton.className =
                        'w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors mt-4';
                    addButton.innerHTML =
                        `<span class="flex items-center justify-center"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Tambah Mahasiswa</span>`;

                    addButton.onclick = function() {
                        const currentCount = document.querySelectorAll('#dynamic-fields-container .dynamic-group')
                            .length;
                        const newIndex = currentCount + 1;
                        const newFields = createDynamicFields(newIndex);
                        container.insertAdjacentHTML('beforeend', newFields);
                    };
                    container.appendChild(addButton);
                }

                console.log(selectedLetterType)
                if (selectedLetterType === 'Surat Izin Penelitian') {
                    researchContainer.classList.remove('hidden');
                    courseContainer.classList.remove('hidden');
                }

                if (selectedLetterType === 'Surat Rekomendasi') {
                    researchContainer.classList.remove('hidden');
                    locationContainer.classList.remove('hidden');
                    waktuContainer.classList.remove('hidden');
                }
            });
        </script>
    @endpush
@endsection
