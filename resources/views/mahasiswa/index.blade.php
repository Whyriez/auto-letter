@extends('layouts.dashboard.layout')
@section('title', 'Mahasiswa | Dashboard')
@section('mahasiswa-dashboard', 'active')



@section('content')
    <!-- Main Content -->
    <div class="lg:ml-64">
        <x-dashboard.topbar :title="'Dashboard'" />


        <!-- Dashboard Content -->
        <main class="p-4 sm:p-6">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang kembali, {{ Auth::user()->name }}</h2>
                <p class="text-gray-600">Kelola surat rekomendasi Anda dan lacak kemajuannya.</p>
            </div>

            <!-- Request New Letter Button -->
            <div class="mb-8">
                <button onclick="openLetterModal()"
                    class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-200 card-shadow">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Minta Surat Baru
                    </div>
                </button>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl p-6 card-shadow">
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
                            <p class="text-sm text-gray-600">Total Letters</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $pendingLetters }}</p>
                            <p class="text-sm text-gray-600">Pending</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $approvedLetters }}</p>
                            <p class="text-sm text-gray-600">Approved</p>
                        </div>
                    </div>
                </div>
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
            <!-- My Letter History -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Riwayat Surat Saya</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse ($letterHistory as $letter)
                        {{-- Menggunakan tautan jika surat sudah selesai, jika tidak, gunakan div biasa --}}
                        @if ($letter->status === 'completed')
                            <a href="{{ Storage::url($letter->final_document_path) }}" target="_blank"
                                class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer block no-underline">
                            @else
                                <div class="bg-white rounded-xl p-6 card-shadow transition-all duration-200 cursor-default">
                        @endif

                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">
                                    {{ $letter->LetterTemplate->nama_surat ?? 'Jenis Surat Tidak Diketahui' }}
                                </h4>
                                <p class="text-sm text-gray-600">
                                    {{ $letter->notes }}
                                </p>
                            </div>
                            @php
                                $statusClass = [
                                    'pending' => 'bg-yellow-200 text-yellow-800',
                                    'rejected' => 'bg-red-200 text-red-800',
                                    'completed' => 'bg-green-200 text-green-800',
                                ];
                            @endphp
                            <span
                                class="px-2 py-1 rounded-full text-xs font-medium {{ $statusClass[$letter->status] ?? 'bg-gray-200 text-gray-800' }}">
                                {{ ucfirst($letter->status) }}
                            </span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>{{ $letter->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Needed By:</span>
                                <span>{{ \Carbon\Carbon::parse($letter->needed_at)->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Code:</span>
                                <span>{{ $letter->unique_code }}</span>
                            </div>
                        </div>

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

    <!-- New Letter Request Modal -->
    <div id="letter-modal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] flex flex-col">
            <!-- Fixed Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 flex-shrink-0">
                <h2 class="text-xl font-semibold text-gray-900">Formulir Permintaan Surat</h2>
                <button onclick="closeLetterModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Scrollable Form Container -->
            <form class="flex flex-col flex-1 min-h-0" action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <!-- Scrollable Modal Body -->
                <div class="flex-1 overflow-y-auto p-6 space-y-6">
                    <!-- Letter Type Dropdown -->
                    <div>
                        <label for="letter-type" class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Jenis Surat <span class="text-red-500">*</span>
                        </label>

                        <select id="letter-type" name="letter-type" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                            <option value="">-- Pilih Jenis Surat --</option>
                            @foreach ($letterTypes as $type)
                                <option value="{{ $type->id }}" data-letter-type="{{ $type->letterType->name }}">
                                    {{ $type->nama_surat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Auto-filled Fields Section -->
                    <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Data Mahasiswa (Otomatis Terisi)</h3>

                        <!-- Full Name -->
                        <div>
                            <label for="full-name" class="block text-sm font-medium text-gray-600 mb-1">
                                Nama Lengkap
                            </label>
                            <input type="text" id="full-name" name="full-name" value="{{ Auth::user()->name }}"
                                readonly
                                class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                        </div>

                        <!-- Student ID -->
                        <div>
                            <label for="nim" class="block text-sm font-medium text-gray-600 mb-1">
                                NIM
                            </label>
                            <input type="text" id="nim" name="nim" value="{{ Auth::user()->nim_nip }}"
                                readonly
                                class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                        </div>

                        <!-- Program Study -->
                        <div>
                            <label for="program-study" class="block text-sm font-medium text-gray-600 mb-1">
                                Program Studi
                            </label>
                            <input type="text" id="program-study" name="program-study"
                                value="{{ Auth::user()->prodi }}" readonly
                                class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                        </div>

                        <!-- Faculty -->
                        <div>
                            <label for="faculty" class="block text-sm font-medium text-gray-600 mb-1">
                                Jurusan
                            </label>
                            <input type="text" id="jurusan" name="jurusan" value="{{ Auth::user()->jurusan }}"
                                readonly
                                class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                        </div>

                        <!-- Semester -->
                        {{-- <div>
                            <label for="semester" class="block text-sm font-medium text-gray-600 mb-1">
                                Semester
                            </label>
                            <input type="text" id="semester" name="semester" value="7" readonly
                                class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                        </div> --}}
                    </div>

                    <div id="dynamic-fields-container" class="space-y-4">
                    </div>

                    <div id="research-fields-container" class="space-y-4 hidden">
                        <div id="location-fields-container" class="hidden">
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                                Lokasi Tujuan
                            </label>
                            <input type="text" id="location" name="location"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900"
                                placeholder="Masukkan lokasi tujuan (contoh: di Jakarta)">
                        </div>

                        <div id="waktu-fields-container" class="hidden">
                            <label for="waktu" class="block text-sm font-medium text-gray-700 mb-1">
                                Waktu
                            </label>
                            <input type="text" id="waktu" name="waktu"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900"
                                placeholder="Masukkan Waktu (contoh: 1 bulan, 1 hari, dst.)">
                        </div>

                        <div id="course-fields-container" class=" hidden">
                            <label for="course" class="block text-sm font-medium text-gray-700 mb-1">
                                Mata Kuliah
                            </label>
                            <input type="text" id="course" name="course"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900"
                                placeholder="Masukkan nama mata kuliah">
                        </div>
                    </div>

                    <!-- Purpose Field -->
                    <div>
                        <label for="purpose" class="block text-sm font-medium text-gray-700 mb-2">
                            Keperluan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="purpose" name="purpose" rows="3" required
                            placeholder="Jelaskan keperluan surat yang diminta..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500 resize-none"></textarea>
                    </div>

                    <!-- Deadline -->
                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Diperlukan <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="deadline" name="deadline" required min="2024-01-01"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                    </div>
                </div>

                <!-- Fixed Action Buttons Footer -->
                <div class="flex-shrink-0 p-6 border-t border-gray-200 bg-white rounded-b-2xl">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="button" onclick="closeLetterModal()"
                            class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-200">
                            Submit Request
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scriptsMahasiswa')
        <script>
            // Letter modal functionality
            function openLetterModal() {
                document.getElementById('letter-modal').classList.remove('hidden');
                document.getElementById('letter-modal').classList.add('flex');
                // Set minimum date to today
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('deadline').setAttribute('min', today);
            }

            function closeLetterModal() {
                document.getElementById('letter-modal').classList.add('hidden');
                document.getElementById('letter-modal').classList.remove('flex');
                // Reset form
                document.querySelector('#letter-modal form').reset();
            }

            // Close modals when clicking outside
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

            // Fungsi untuk menghapus field dinamis
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
                    // Perbarui data-index
                    container.setAttribute('data-index', newIndex);
                    // Perbarui judul
                    container.querySelector('h3').textContent = `Mahasiswa Tambahan #${newIndex}`;
                    // Perbarui label dan id input
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


            // Mendengarkan perubahan pada dropdown jenis surat
            document.getElementById('letter-type').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const selectedLetterType = selectedOption.dataset.letterType;

                const container = document.getElementById('dynamic-fields-container');
                const researchContainer = document.getElementById('research-fields-container');
                const locationContainer = document.getElementById('location-fields-container');
                const waktuContainer = document.getElementById('waktu-fields-container');
                const courseContainer = document.getElementById('course-fields-container');

                // Kosongkan kontainer dinamis dan sembunyikan semua kontainer tambahan
                container.innerHTML = '';
                researchContainer.classList.add('hidden');
                locationContainer.classList.add('hidden');
                waktuContainer.classList.add('hidden');
                courseContainer.classList.add('hidden');

                // Cek apakah jenis surat memerlukan field dinamis "Tambah Mahasiswa"
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

                // Tampilkan field spesifik berdasarkan jenis surat
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
