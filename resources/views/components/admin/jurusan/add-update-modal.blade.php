<div id="template-modal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col overflow-hidden">

            <div class="flex items-center justify-between p-6 border-b border-gray-200 flex-shrink-0">
                <h2 id="modal-title" class="text-xl font-semibold text-gray-900">Buat Template Surat Baru</h2>
                <button onclick="closeTemplateModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('template-surat.store') }}"
                onsubmit="document.querySelector('#isi_konten').value = quill.root.innerHTML;"
                class="flex-1 flex flex-col overflow-hidden">
                @csrf
                <div class="flex-1 overflow-y-auto p-6 space-y-6">

                    <!-- Template Name -->
                    <div>
                        <label for="template-name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="template-name" name="template_name" required
                            placeholder="Enter template name..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="template-category" class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Surat <span class="text-red-500">*</span>
                        </label>
                        <select id="template-category" name="template_category" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                            <option value="">-- Pilih Kategori --</option>
                            {{-- Loop untuk menampilkan data dari database --}}
                            @foreach ($letterTypes as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Header Content -->

                    <div>
                        <label for="kode_seri" class="block text-md font-bold text-gray-700">
                            Nomor Surat
                        </label>
                        <label for="kode_seri" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Seri (Contoh: B) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kode_seri" name="kode_seri" required
                            placeholder="Masukkan kode seri..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <div>
                        <label for="kode_unit" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Unit (Contoh: UN47.B5.5) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kode_unit" name="kode_unit" required
                            placeholder="Masukkan kode unit..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <div>
                        <label for="kode_arsip" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Arsip (Contoh: PK.01.06) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kode_arsip" name="kode_arsip" required
                            placeholder="Masukkan kode arsip..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <div>
                        <label for="tujuan_nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Perihal (Contoh: Rekomendasi Magang) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="perihal" name="perihal" required placeholder="Masukkan perihal..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <!-- Header Content -->
                    <div>
                        <label for="tujuan_nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Tujuan Nama (Contoh: Koordinator Fakultas Teknik) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="tujuan_nama" name="tujuan_nama" required
                            placeholder="Masukkan nama tujuan..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <div>
                        <label for=tujuan_tempat" class="block text-sm font-medium text-gray-700 mb-2">
                            Tujuan Tempat (Contoh: Gorontalo) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="tujuan_tempat" name="tujuan_tempat" required
                            placeholder="Masukkan tempat tujuan..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <!-- Body Content -->
                    <div>
                        <label for="isi_konten" class="block text-sm font-medium text-gray-700 mb-2">
                            Isi Konten <span class="text-red-500">*</span>
                        </label>

                        {{-- <textarea id="isi_konten" name="isi_konten"></textarea> --}}
                        <div id="editor">


                        </div>
                        <textarea id="isi_konten" name="konten" hidden></textarea>

                        @verbatim
                            <div
                                class="mt-2 text-xs text-gray-600 bg-gray-50 border border-gray-200 rounded-lg p-3 leading-relaxed">
                                <p class="font-medium mb-1">📌 Gunakan placeholder berikut untuk konten dinamis:</p>
                                <ul class="list-disc list-inside space-y-2 text-gray-700">
                                    <li>
                                        <code
                                            class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ SPASI_PENYELARAS }}</code>
                                        <p class="mt-1">
                                            Placeholder ini digunakan untuk menyelaraskan teks seperti tabel.
                                            <br>
                                            <span class="font-semibold text-gray-800">Contoh Penggunaan:</span><br>
                                            <span class="font-mono text-xs">
                                                Nama {{ SPASI_PENYELARAS }} {{ $nama_dsn }}<br>
                                                Jabatan {{ SPASI_PENYELARAS }} {{ $jabatan }}
                                            </span>
                                            <br><br>
                                            <span class="font-semibold text-gray-800">Hasil:</span><br>
                                        <table style="width:100%; border-collapse: collapse; font-size: 0.75rem;">
                                            <tr>
                                                <td style="width:15%; padding: 0;">Nama</td>
                                                <td style="padding: 0;">: [Nama Dosen]</td>
                                            </tr>
                                            <tr>
                                                <td style="width:15%; padding: 0;">Jabatan</td>
                                                <td style="padding: 0;">: [Jabatan Dosen]</td>
                                            </tr>
                                        </table>
                                        </p>
                                    </li>

                                    <li>
                                        <code
                                            class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ $nama_mhs }}</code>
                                        <span class="font-semibold text-gray-800">→ Nama Mahasiswa Utama</span>
                                        <p class="mt-1">
                                            <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                            <span class="font-mono text-xs">[Nama Mahasiswa]</span>
                                        </p>
                                    </li>
                                    <li>
                                        <code
                                            class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ $nim }}</code>
                                        <span class="font-semibold text-gray-800">→ NIM Mahasiswa Utama</span>
                                        <p class="mt-1">
                                            <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                            <span class="font-mono text-xs">[NIM Mahasiswa]</span>
                                        </p>
                                    </li>

                                    <li>
                                        <code
                                            class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ $nama_dsn }}</code>
                                        <span class="font-semibold text-gray-800">→ Nama Penanda Tangan (Dosen)</span>
                                        <p class="mt-1">
                                            <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                            <span class="font-mono text-xs">[Nama Dosen]</span>
                                        </p>
                                    </li>
                                    <li>
                                        <code
                                            class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ $nip }}</code>
                                        <span class="font-semibold text-gray-800">→ NIP Penanda Tangan (Dosen)</span>
                                        <p class="mt-1">
                                            <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                            <span class="font-mono text-xs">[NIP Dosen]</span>
                                        </p>
                                    </li>
                                    <li>
                                        <code
                                            class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ $jabatan }}</code>
                                        <span class="font-semibold text-gray-800">→ Jabatan Penanda Tangan (Dosen)</span>
                                        <p class="mt-1">
                                            <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                            <span class="font-mono text-xs">[Jabatan Dosen]</span>
                                        </p>
                                    </li>

                                    <li>
                                        <code
                                            class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ $lokasi }}</code>
                                        <span class="font-semibold text-gray-800">→ Lokasi Tujuan</span>
                                        <p class="mt-1">
                                            <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                            <span class="font-mono text-xs">[Lokasi Tujuan]</span>
                                        </p>
                                    </li>
                                    <li>
                                        <code
                                            class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ $waktu }}</code>
                                        <span class="font-semibold text-gray-800">→ Waktu (Hari, Bulan, Tanggal,
                                            Jam)</span>
                                        <p class="mt-1">
                                            <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                            <span class="font-mono text-xs">[Waktu]</span>
                                        </p>
                                    </li>
                                    <li>
                                        <code
                                            class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ $mata_kuliah }}</code>
                                        <span class="font-semibold text-gray-800">→ Mata Kuliah</span>
                                        <p class="mt-1">
                                            <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                            <span class="font-mono text-xs">[Mata Kuliah]</span>
                                        </p>
                                    </li>

                                    <li>
                                        <code
                                            class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ $array_mhs }}</code>
                                        <span class="font-semibold text-gray-800">→ Daftar Mahasiswa Tambahan</span>
                                        <p class="mt-1">
                                            <span class="font-semibold text-gray-800">Hasil:</span><br>
                                        <table style="width:100%; border-collapse: collapse; font-size: 0.75rem;">
                                            <tr>
                                                <td style="width:5%; padding: 0;">1.</td>
                                                <td style="width:50%; padding: 0;">[Nama Mahasiswa]</td>
                                                <td style="width:45%; padding: 0;">NIM. [NIM Mahasiswa]</td>
                                            </tr>
                                            <tr>
                                                <td style="width:5%; padding: 0;">2.</td>
                                                <td style="width:50%; padding: 0;">[Nama Mahasiswa]</td>
                                                <td style="width:45%; padding: 0;">NIM. [NIM Mahasiswa]</td>
                                            </tr>
                                        </table>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        @endverbatim
                    </div>

                    <div>
                        <label for="forward_to" class="block text-sm font-medium text-gray-700 mb-2">
                            Penerusan Surat
                        </label>
                        <select id="forward_to" name="forward_to"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-900">
                            <option value="">-- Pilih Penerima --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ ucfirst($user->role) }} - {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Template Status -->
                    <div>
                        <label for="template-status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="template-status" name="status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                            <option value="active">Active</option>
                            <option value="draft">Draft</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                </div>

                <!-- Action Buttons - Fixed at bottom, inside form -->
                <div class="flex flex-col sm:flex-row gap-3 p-6 border-t border-gray-200 flex-shrink-0 bg-white">
                    <button type="button" onclick="closeTemplateModal()"
                        class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-200">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-200">
                        <span id="submit-text">Buat Template</span>
                    </button>
                </div>
            </form>
        </div>
    </div>