<!-- ===== Modal: Impor Pengguna (CSV/Excel) ===== -->
<div id="import-users-modal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 px-4" role="dialog"
    aria-modal="true" aria-labelledby="import-users-title">

    <!-- Overlay (for animation) -->
    <div class="absolute inset-0" data-modal-overlay></div>

    <!-- Panel -->
    <div class="relative bg-white rounded-2xl shadow-2xl max-w-5xl w-full max-h-[90vh] flex flex-col overflow-hidden"
        data-modal-panel>

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-red-50 flex-shrink-0">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-red-600 shadow-sm">
                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" aria-hidden="true">
                        <path d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.5 10.5 12 6m0 0 4.5 4.5M12 6v12" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
                <div>
                    <h2 id="import-users-title" class="text-lg font-semibold text-gray-900">Impor Mahasiswa (CSV/Excel)
                    </h2>
                    <p class="text-xs text-gray-600">Unggah satu file .csv / .xlsx / .xls, pilih sheet (jika ada), cek
                        pratinjau,
                        lalu “Impor”.</p>
                </div>
            </div>
            <button onclick="closeImportUsersModal()" class="text-gray-400 hover:text-gray-600 transition-colors"
                aria-label="Tutup">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form -->
        <form id="import-users-form" method="POST" action="{{ route('super_admin.import_mahasiswa') }}"
            enctype="multipart/form-data" class="flex-1 overflow-y-auto p-6 space-y-6">
            @csrf
            <input type="hidden" name="sheet" id="sheet-hidden" />

            <!-- Dropzone besar -->
            <div id="dz" data-dropzone
                class="relative border-2 border-dashed border-gray-300 rounded-2xl p-6 sm:p-8 bg-gray-50 hover:border-red-300 transition-colors cursor-pointer select-none">

                <!-- STATE: Instruksi awal -->
                <div id="dz-empty" class="dz-state flex flex-col items-center justify-center text-center py-8">
                    <div class="mx-auto w-16 h-16 rounded-2xl bg-white flex items-center justify-center shadow mb-4">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-gray-500" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" aria-hidden="true">
                            <path d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7.5 10.5 12 6m0 0 4.5 4.5M12 6v12" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <p class="text-gray-900 font-medium">Klik area ini atau seret & jatuhkan file di sini</p>
                    <p class="text-xs text-gray-500">Format: .csv, .xlsx, .xls &middot; Maks 5&nbsp;MB</p>
                </div>

                <!-- STATE: Setelah pilih file (file info + sheet select + preview) -->
                <div id="dz-preview" class="dz-state hidden">
                    <div class="flex flex-col gap-4">
                        <!-- Bar atas: info file + actions -->
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                            <div class="min-w-0">
                                <div class="text-sm text-gray-700 truncate">
                                    <span class="font-semibold text-gray-900" id="file-name"></span>
                                    <span class="text-gray-500" id="file-size"></span>
                                </div>
                                <div class="text-xs text-gray-500" id="file-meta"></div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div id="sheet-select-wrap" class="hidden">
                                    <label class="text-sm text-gray-600 mr-2">Pilih Sheet:</label>
                                    <select id="sheet-select"
                                        class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"></select>
                                </div>
                                <button type="button" id="btn-change-file"
                                    class="px-3 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-100 text-gray-700">
                                    Ganti File
                                </button>
                            </div>
                        </div>

                        <!-- Preview table -->
                        <div class="rounded-xl border border-gray-200 bg-white overflow-hidden">
                            <div class="px-4 py-2 border-b border-gray-200 flex items-center justify-between">
                                <div class="text-sm font-medium text-gray-800">Pratinjau (10 baris pertama)</div>
                                <div class="text-xs text-gray-500" id="preview-stats"></div>
                            </div>
                            <div class="overflow-auto max-h-80" id="preview-table-wrap">
                                <table class="min-w-full text-sm text-left">
                                    <thead id="preview-thead" class="bg-gray-50 text-gray-700"></thead>
                                    <tbody id="preview-tbody" class="divide-y divide-gray-100"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Input file (hidden) -->
                <input id="import-file" name="file" type="file" class="hidden" required
                    accept=".csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.xlsx,.xls,text/csv" />

                <!-- Overlay dragover -->
                <div
                    class="dz-overlay pointer-events-none absolute inset-0 rounded-2xl bg-black/50 flex items-center justify-center opacity-0 transition-opacity">
                    <div class="text-center text-white">
                        <div class="text-lg sm:text-xl font-semibold mb-1">Jatuhkan sekarang — ini panas! 🔥</div>
                        <div class="text-xs sm:text-sm text-white/80">Lepas file untuk memulai unggahan</div>
                    </div>
                </div>
            </div>

            <!-- Error kecil -->
            <p id="dz-error" class="hidden text-sm text-red-600"></p>

            <!-- Kartu: Unduh Template -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <span
                            class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-red-50 text-red-600">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11V3m0 8l3-3m-3 3L9 8M5 12v6a2 2 0 002 2h10a2 2 0 002-2v-6M7 15h10" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-base font-semibold text-gray-900">Template CSV untuk Impor</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                Catatan: <span class="font-medium text-gray-800">untuk melakukan impor data, harus
                                    sesuai dengan format template ini</span>.
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('super_admin.users.template') }}"
                        class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 rounded-lg bg-red-600 text-white font-medium hover:bg-red-700 transition-colors">
                        Unduh Template
                    </a>
                </div>
            </div>
        </form>

        <!-- Footer -->
        <div class="flex flex-col sm:flex-row gap-3 px-6 py-4 border-t border-gray-200 bg-white flex-shrink-0">
            <button type="button" onclick="closeImportUsersModal()"
                class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200">
                Batal
            </button>
            <button type="submit" form="import-users-form"
                class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-red-200 transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-4 h-4 hidden animate-spin" data-submit-spinner viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" aria-hidden="true">
                    <circle cx="12" cy="12" r="9" stroke-width="2" class="opacity-25"></circle>
                    <path d="M21 12a9 9 0 00-9-9" stroke-width="2" class="opacity-75"></path>
                </svg>
                <span data-submit-text>Impor</span>
            </button>
        </div>

    </div>
</div>

<style>
    @keyframes overlay-in {
        from {
            opacity: 0
        }

        to {
            opacity: 1
        }
    }

    @keyframes overlay-out {
        from {
            opacity: 1
        }

        to {
            opacity: 0
        }
    }

    @keyframes panel-in {
        from {
            opacity: 0;
            transform: translateY(8px) scale(.98)
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1)
        }
    }

    @keyframes panel-out {
        from {
            opacity: 1;
            transform: translateY(0) scale(1)
        }

        to {
            opacity: 0;
            transform: translateY(8px) scale(.98)
        }
    }

    .modal-overlay-in {
        animation: overlay-in .18s ease-out forwards
    }

    .modal-overlay-out {
        animation: overlay-out .14s ease-in forwards
    }

    .modal-panel-in {
        animation: panel-in .22s cubic-bezier(.22, .61, .36, 1) forwards
    }

    .modal-panel-out {
        animation: panel-out .16s ease-in forwards
    }

    #dz.dz-dragover {
        border-color: #ef4444;
        background-color: #0b0f190f
    }

    #dz.dz-dragover .dz-overlay {
        opacity: 1
    }

    /* kecilkan table preview */
    #preview-table-wrap table th,
    #preview-table-wrap table td {
        padding: .5rem .75rem;
        white-space: nowrap;
    }
</style>

@push('scriptsImport')
    <script>
        function openImportUsersModal() {
            const modal = document.getElementById('import-users-modal');
            const overlay = modal.querySelector('[data-modal-overlay]');
            const panel = modal.querySelector('[data-modal-panel]');
            resetDropzone(true);
            document.getElementById('dz-error').classList.add('hidden');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            overlay.classList.remove('modal-overlay-out');
            panel.classList.remove('modal-panel-out');
            void overlay.offsetWidth;
            overlay.classList.add('modal-overlay-in');
            panel.classList.add('modal-panel-in');
        }

        function closeImportUsersModal() {
            const modal = document.getElementById('import-users-modal');
            const overlay = modal.querySelector('[data-modal-overlay]');
            const panel = modal.querySelector('[data-modal-panel]');
            overlay.classList.remove('modal-overlay-in');
            panel.classList.remove('modal-panel-in');
            overlay.classList.add('modal-overlay-out');
            panel.classList.add('modal-panel-out');
            panel.addEventListener('animationend', () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, {
                once: true
            });
        }

        // tutup saat klik luar panel
        document.getElementById('import-users-modal').addEventListener('click', (e) => {
            const panel = e.currentTarget.querySelector('[data-modal-panel]');
            if (!panel.contains(e.target)) closeImportUsersModal();
        });
        // esc untuk tutup
        document.addEventListener('keydown', (e) => {
            const modal = document.getElementById('import-users-modal');
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeImportUsersModal();
        });

        let _wb = null,
            _sheets = [],
            _activeSheet = '';

        (function initDropzone() {
            const dz = document.getElementById('dz');
            const dzEmpty = document.getElementById('dz-empty');
            const dzPreview = document.getElementById('dz-preview');
            const input = document.getElementById('import-file');
            const errEl = document.getElementById('dz-error');
            const selWrap = document.getElementById('sheet-select-wrap');
            const sel = document.getElementById('sheet-select');
            const btnChange = document.getElementById('btn-change-file');

            // ⬅️ hanya area instruksi awal yang memicu file picker
            dz.addEventListener('click', (e) => {
                if (e.target.closest('#dz-empty')) {
                    input.click();
                }
            });
            // tombol "Ganti File" memicu picker
            btnChange.addEventListener('click', (e) => {
                e.stopPropagation();
                triggerChangeFile();
            });
            // jangan bubbling dari select (biar gak buka file dialog)
            sel.addEventListener('click', (e) => e.stopPropagation());

            // drag n drop
            ['dragenter', 'dragover'].forEach(ev =>
                dz.addEventListener(ev, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dz.classList.add('dz-dragover');
                })
            );
            ['dragleave', 'drop'].forEach(ev =>
                dz.addEventListener(ev, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dz.classList.remove('dz-dragover');
                })
            );
            dz.addEventListener('drop', (e) => {
                const file = e.dataTransfer?.files?.[0];
                if (file) setFile(file);
            });
            // pilih file normal
            input.addEventListener('change', (e) => {
                const file = e.target.files?.[0];
                if (file) setFile(file);
            });

            async function setFile(file) {
                errEl.classList.add('hidden');
                if (!validateFile(file)) {
                    resetDropzone();
                    return;
                }

                // tampilkan UI preview state
                dzEmpty.classList.add('hidden');
                dzPreview.classList.remove('hidden');

                // meta
                document.getElementById('file-name').textContent = file.name;
                document.getElementById('file-size').textContent = ` (${bytes(file.size)})`;
                document.getElementById('file-meta').textContent = file.type || 'Unknown MIME';

                // set ke input (ikut submit)
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;

                try {
                    const buf = await file.arrayBuffer();
                    if (!window.XLSX) {
                        throw new Error('XLSX tidak tersedia. Pastikan CDN dimuat sebelum script ini.');
                    }
                    _wb = XLSX.read(buf, {
                        type: 'array'
                    });
                    _sheets = _wb.SheetNames || [];
                    const isCSV = /\.csv$/i.test(file.name);

                    // atur sheet select
                    sel.innerHTML = '';
                    if (_sheets.length > 1) {
                        selWrap.classList.remove('hidden');
                        _sheets.forEach(n => {
                            const opt = document.createElement('option');
                            opt.value = n;
                            opt.textContent = n;
                            sel.appendChild(opt);
                        });
                        _activeSheet = _sheets[0];
                    } else {
                        selWrap.classList.add('hidden');
                        _activeSheet = _sheets[0] || (isCSV ? 'CSV' : 'Sheet1');
                    }
                    document.getElementById('sheet-hidden').value = _activeSheet;

                    // render preview
                    renderPreview(_activeSheet);

                    // sheet change
                    sel.onchange = () => {
                        _activeSheet = sel.value;
                        document.getElementById('sheet-hidden').value = _activeSheet;
                        renderPreview(_activeSheet);
                    };

                } catch (err) {
                    console.error(err);
                    errEl.textContent = 'Gagal membaca file. Pastikan file valid.';
                    errEl.classList.remove('hidden');
                    resetDropzone();
                }
            }
        })();

        function triggerChangeFile() {
            resetDropzone();
            document.getElementById('import-file').click();
        }

        function validateFile(file) {
            const errEl = document.getElementById('dz-error');
            if (!file) {
                errEl.textContent = 'Tidak ada file.';
                errEl.classList.remove('hidden');
                return false;
            }
            const okExt = /\.(csv|xlsx|xls)$/i.test(file.name);
            const okMime = [
                'text/csv',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ].includes(file.type) || okExt;
            if (!okMime) {
                errEl.textContent = 'Format tidak didukung. Gunakan .csv, .xlsx, atau .xls.';
                errEl.classList.remove('hidden');
                return false;
            }
            const max = 5 * 1024 * 1024;
            if (file.size > max) {
                errEl.textContent = 'Ukuran file terlalu besar. Maksimum 5 MB.';
                errEl.classList.remove('hidden');
                return false;
            }
            return true;
        }

        function renderPreview(sheetName) {
            const thead = document.getElementById('preview-thead');
            const tbody = document.getElementById('preview-tbody');
            const stats = document.getElementById('preview-stats');
            thead.innerHTML = '';
            tbody.innerHTML = '';
            stats.textContent = '';

            const ws = _wb?.Sheets?.[sheetName] || (_wb?.SheetNames?.length ? _wb.Sheets[_wb.SheetNames[0]] : null);
            if (!ws) {
                tbody.innerHTML = `<tr><td class="px-3 py-2 text-gray-500">Sheet tidak ditemukan.</td></tr>`;
                return;
            }
            const rows = XLSX.utils.sheet_to_json(ws, {
                header: 1,
                raw: true
            });
            const totalRows = rows.length;
            const previewRows = rows.slice(0, 10);
            const maxCols = Math.min(12, (previewRows[0]?.length || 0));

            const header = previewRows[0] || [];
            thead.innerHTML =
                `<tr>${header.slice(0,maxCols).map(h=>`<th class="px-3 py-2 font-semibold">${escapeHTML(h ?? '')}</th>`).join('')}</tr>`;

            const bodyHTML = previewRows.slice(1).map(r => {
                const tds = Array.from({
                    length: maxCols
                }).map((_, i) => `<td class="px-3 py-2">${escapeHTML(r?.[i] ?? '')}</td>`).join('');
                return `<tr class="hover:bg-gray-50">${tds}</tr>`;
            }).join('');
            tbody.innerHTML = bodyHTML ||
                `<tr><td class="px-3 py-2 text-gray-500">Tidak ada data untuk ditampilkan.</td></tr>`;

            const colsCount = header.length;
            stats.textContent = `Sheet: ${sheetName} • Baris: ${totalRows} • Kolom: ${colsCount}`;
        }

        function resetDropzone() {
            const dzEmpty = document.getElementById('dz-empty');
            const dzPrev = document.getElementById('dz-preview');
            const input = document.getElementById('import-file');
            const selWrap = document.getElementById('sheet-select-wrap');
            const sel = document.getElementById('sheet-select');

            input.value = '';
            document.getElementById('sheet-hidden').value = '';
            document.getElementById('dz-error').classList.add('hidden');
            selWrap.classList.add('hidden');
            sel.innerHTML = '';

            dzPrev.classList.add('hidden');
            dzEmpty.classList.remove('hidden');

            // clear preview
            document.getElementById('file-name').textContent = '';
            document.getElementById('file-size').textContent = '';
            document.getElementById('file-meta').textContent = '';
            document.getElementById('preview-thead').innerHTML = '';
            document.getElementById('preview-tbody').innerHTML = '';
            document.getElementById('preview-stats').textContent = '';
            _wb = null;
            _sheets = [];
            _activeSheet = '';
        }

        function bytes(n) {
            if (n < 1024) return n + ' B';
            const kb = n / 1024;
            if (kb < 1024) return kb.toFixed(1) + ' KB';
            return (kb / 1024).toFixed(1) + ' MB';
        }

        function escapeHTML(v) {
            return String(v ?? '').replace(/[&<>"']/g, s => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            } [s]));
        }

        // proteksi double submit + spinner
        document.getElementById('import-users-form').addEventListener('submit', function() {
            const modal = document.getElementById('import-users-modal');
            const btn = modal.querySelector('button[form="import-users-form"]');
            const spin = modal.querySelector('[data-submit-spinner]');
            const text = modal.querySelector('[data-submit-text]');
            btn.disabled = true;
            spin.classList.remove('hidden');
            text.textContent = 'Mengunggah...';
        });
    </script>
@endpush
