<div id="template-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">

    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] flex flex-col overflow-hidden">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-red-50 flex-shrink-0">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white shadow-sm">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 16h8M8 12h8m-6-8h2a2 2 0 012 2v2h2a2 2 0 012 2v8a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>
                </span>
                <div>
                    <h2 id="modal-title" class="text-lg font-semibold text-gray-900">Buat Template Surat Baru</h2>
                    <p class="text-xs text-gray-600">
                        Lengkapi informasi dasar, penomoran, dan isi konten. Placeholder bisa kamu sisipkan dari panel
                        “Isi Konten”.
                    </p>
                </div>
            </div>
            <button onclick="closeTemplateModal()" class="text-gray-400 hover:text-gray-600 transition-colors"
                aria-label="Tutup">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="template-form" method="POST" action="{{ route('template-surat.store') }}"
            onsubmit="document.getElementById('isi_konten').value = quill.root.innerHTML;"
            class="flex-1 overflow-y-auto px-6 py-6 space-y-8">
            @csrf

            <section class="bg-white rounded-xl border border-gray-200 p-5">
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Dasar</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="template-name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="template-name" name="template_name" required
                            placeholder="Contoh: Rekomendasi Magang"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>

                    <div>
                        <label for="template-category" class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Surat <span class="text-red-500">*</span>
                        </label>
                        <select id="template-category" name="template_category" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($letterTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="template-status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="template-status" name="status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="active">Active</option>
                            <option value="draft">Draft</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="forward_to" class="block text-sm font-medium text-gray-700 mb-2">
                            Penerusan Surat
                        </label>
                        <select id="forward_to" name="forward_to"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">-- Pilih Penerima --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ ucfirst($user->role) }} - {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Opsional: otomatis teruskan template ini ke user tertentu.
                        </p>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-xl border border-gray-200 p-5">
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h10M7 17h10M9 3v18M15 3v18" />
                    </svg>

                    <h3 class="text-lg font-semibold text-gray-900">Penomoran Surat</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex flex-col">
                        <label for="kode_seri" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Seri <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kode_seri" name="kode_seri" required placeholder="Contoh: B"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="kode_unit" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Unit <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kode_unit" name="kode_unit" required
                            placeholder="Contoh: UN47.B5.5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="kode_arsip" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Arsip <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kode_arsip" name="kode_arsip" required
                            placeholder="Contoh: PK.01.06"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">Nomor akhir akan digenerate otomatis saat approval (berdasarkan
                    tahun & template).</p>
            </section>

            <section class="bg-white rounded-xl border border-gray-200 p-5">
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>

                    <h3 class="text-lg font-semibold text-gray-900">Perihal & Tujuan</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="perihal" class="block text-sm font-medium text-gray-700 mb-2">
                            Perihal <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="perihal" name="perihal" required
                            placeholder="Contoh: Rekomendasi Magang"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>

                    <div class="flex flex-col">
                        <label for="tujuan_nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Tujuan Nama <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="tujuan_nama" name="tujuan_nama" required
                            placeholder="Contoh: Koordinator Fakultas Teknik"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>

                    <div class="flex flex-col">
                        <label for="tujuan_tempat" class="block text-sm font-medium text-gray-700 mb-2">
                            Tujuan Tempat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="tujuan_tempat" name="tujuan_tempat" required
                            placeholder="Contoh: Gorontalo"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h10M4 14h8M4 18h16" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Isi Konten</h3>
                    </div>
                    <span class="text-xs text-gray-500">Gunakan placeholder untuk data dinamis</span>
                </div>

                <div id="editor" class="border border-gray-300 rounded-lg min-h-[220px]"></div>
                <textarea id="isi_konten" name="konten" hidden></textarea>

                @verbatim
                    <div
                        class="mt-3 text-xs text-gray-600 bg-gray-50 border border-gray-200 rounded-lg p-3 leading-relaxed">
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
                                    class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ NAMA_MAHASISWA }}</code>
                                <span class="font-semibold text-gray-800">→ Nama Mahasiswa Utama</span>
                                <p class="mt-1">
                                    <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                    <span class="font-mono text-xs">[Nama Mahasiswa]</span>
                                </p>
                            </li>
                            <li>
                                <code
                                    class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ NIM }}</code>
                                <span class="font-semibold text-gray-800">→ NIM Mahasiswa Utama</span>
                                <p class="mt-1">
                                    <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                    <span class="font-mono text-xs">[NIM Mahasiswa]</span>
                                </p>
                            </li>

                            <li>
                                <code
                                    class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ NAMA_DOSEN }}</code>
                                <span class="font-semibold text-gray-800">→ Nama Penanda Tangan (Dosen)</span>
                                <p class="mt-1">
                                    <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                    <span class="font-mono text-xs">[Nama Dosen]</span>
                                </p>
                            </li>
                            <li>
                                <code
                                    class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ NIP }}</code>
                                <span class="font-semibold text-gray-800">→ NIP Penanda Tangan (Dosen)</span>
                                <p class="mt-1">
                                    <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                    <span class="font-mono text-xs">[NIP Dosen]</span>
                                </p>
                            </li>
                            <li>
                                <code
                                    class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ JABATAN }}</code>
                                <span class="font-semibold text-gray-800">→ Jabatan Penanda Tangan (Dosen)</span>
                                <p class="mt-1">
                                    <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                    <span class="font-mono text-xs">[Jabatan Dosen]</span>
                                </p>
                            </li>

                            <li>
                                <code
                                    class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ LOKASI }}</code>
                                <span class="font-semibold text-gray-800">→ Lokasi Tujuan</span>
                                <p class="mt-1">
                                    <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                    <span class="font-mono text-xs">[Lokasi Tujuan]</span>
                                </p>
                            </li>
                            <li>
                                <code
                                    class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ WAKTU }}</code>
                                <span class="font-semibold text-gray-800">→ Waktu (Hari, Bulan, Tanggal, Jam)</span>
                                <p class="mt-1">
                                    <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                    <span class="font-mono text-xs">[Waktu]</span>
                                </p>
                            </li>
                            <li>
                                <code
                                    class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ MATA_KULIAH }}</code>
                                <span class="font-semibold text-gray-800">→ Mata Kuliah</span>
                                <p class="mt-1">
                                    <span class="font-semibold text-gray-800">Contoh Hasil:</span><br>
                                    <span class="font-mono text-xs">[Mata Kuliah]</span>
                                </p>
                            </li>

                            <li>
                                <code
                                    class="bg-gray-100 px-1 py-0.5 rounded text-red-600 font-mono text-sm">{{ DAFTAR_MAHASISWA }}</code>
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
            </section>
        </form>

        <div class="flex flex-col sm:flex-row gap-3 px-6 py-4 border-t border-gray-200 bg-white flex-shrink-0">
            <button type="button" onclick="closeTemplateModal()"
                class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200">
                Batal
            </button>

            {{-- Tombol submit: ada spinner tersembunyi agar layout stabil --}}
            <button type="submit" form="template-form"
                class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-red-200 transition-all duration-200 inline-flex items-center justify-center gap-2">
                <svg class="w-4 h-4 hidden animate-spin" data-submit-spinner viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" aria-hidden="true">
                    <circle cx="12" cy="12" r="9" stroke-width="2" class="opacity-25"></circle>
                    <path d="M21 12a9 9 0 00-9-9" stroke-width="2" class="opacity-75"></path>
                </svg>
                <span id="submit-text">Buat Template</span>
            </button>
        </div>


    </div>
</div>
