@extends('layouts.dashboard.layout')
@section('title', 'Mahasiswa | Update Profile')
@section('profile-settings', 'active')

@section('content')
    <div class="lg:ml-64">
        <x-dashboard.topbar :title="'Update Profile'" />

        @php
            $user = auth()->user();
            $role = $user->role ?? 'mahasiswa';

            $showAcademic = in_array($role, ['mahasiswa', 'kaprodi', 'admin_jurusan', 'kajur']);
            $showProdi = in_array($role, ['mahasiswa', 'kaprodi']);
            $idLabel = $role === 'mahasiswa' ? 'NIM' : 'NIP';

            $nimnip = $user->nim_nip ?? ($user->nim ?? ($user->nip ?? null));
            $jurusan = $user->jurusan ?? null;
            $prodi = $user->prodi ?? null;

            $needsQRCode = in_array($role, ['kajur', 'kaprodi']);

            $rawQr = $user->signature_image_path ?? null;
            $qrUrl = null;
            if ($rawQr) {
                if (\Illuminate\Support\Str::startsWith($rawQr, ['/storage/', 'http://', 'https://'])) {
                    $qrUrl = $rawQr;
                } else {
                    $qrUrl = \Illuminate\Support\Facades\Storage::url($rawQr);
                }
            }
            $hasQr = !empty($qrUrl);
        @endphp

        <main class="p-4 sm:p-6">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Update Profile</h2>
                <p class="text-gray-600">
                    Perbarui informasi akunmu
                    @if ($needsQRCode)
                        . Untuk {{ $role === 'kajur' ? 'Kajur' : 'Kaprodi' }}, TTD berupa QR Code.
                    @endif
                </p>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                <div class="xl:col-span-2 bg-white rounded-2xl p-6 card-shadow transition-transform hover:-translate-y-1.5">
                    <form action="{{ route('dashboard.setting.update') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-8">
                        @csrf
                        @method('PUT')
                        @if ($needsQRCode)
                            <div class="border-b pb-6">
                                <div class="flex items-center gap-2 mb-4 ">
                                    <svg width="25" height="25" viewBox="0 0 56 56" class="text-red-600"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <path
                                            d="M8.383 21.402c1.219 0 1.875-.68 1.875-1.922v-5.53c0-2.438 1.312-3.68 3.656-3.68h5.672c1.219 0 1.898-.68 1.898-1.899 0-1.195-.68-1.875-1.898-1.875h-5.742c-4.875 0-7.36 2.414-7.36 7.242v5.743c0 1.242.68 1.921 1.899 1.921m39.234 0c1.242 0 1.899-.68 1.899-1.922v-5.742c0-4.828-2.438-7.242-7.36-7.242h-5.719c-1.242 0-1.921.68-1.921 1.875 0 1.219.68 1.899 1.921 1.899h5.672c2.297 0 3.633 1.242 3.633 3.68v5.53c0 1.243.68 1.922 1.875 1.922m-20.625 4.57v-8.179c0-.562-.445-1.031-1.031-1.031h-8.156c-.586 0-1.032.468-1.032 1.031v8.18c0 .562.446 1.008 1.032 1.008h8.156c.586 0 1.031-.446 1.031-1.008m4.055-7.171h6.14v6.14h-6.14Zm4.36 4.36v-2.556h-2.555v2.555Zm-12.235 0v-2.556h-2.578v2.555Zm-4.36 7.898h6.141v6.14h-6.14Zm20.11.796v-2.554h-2.555v2.555Zm-7.055 0v-2.554h-2.555v2.555Zm-8.695 3.54V32.84h-2.578v2.554Zm12.234 0V32.84h-2.578v2.554Zm1.031 14.109h5.72c4.921 0 7.359-2.438 7.359-7.266V36.52c0-1.243-.68-1.922-1.899-1.922s-1.875.68-1.875 1.922v5.53c0 2.438-1.336 3.68-3.633 3.68h-5.672c-1.242 0-1.921.68-1.921 1.899 0 1.195.68 1.875 1.921 1.875m-22.593 0h5.742c1.219 0 1.898-.68 1.898-1.875 0-1.219-.68-1.898-1.898-1.898h-5.672c-2.344 0-3.656-1.243-3.656-3.68V36.52c0-1.243-.68-1.922-1.875-1.922-1.242 0-1.899.68-1.899 1.922v5.718c0 4.852 2.485 7.266 7.36 7.266m18.023-10.57v-2.555h-2.555v2.555Zm7.055 0v-2.555h-2.555v2.555Zm.305-12.961v-8.18c0-.562-.446-1.031-1.032-1.031H30.04c-.586 0-1.031.468-1.031 1.031v8.18c0 .562.445 1.008 1.03 1.008h8.157c.586 0 1.032-.446 1.032-1.008M18.812 18.8h6.141v6.14h-6.14Zm8.18 19.406v-8.18c0-.562-.445-1.007-1.031-1.007h-8.156c-.586 0-1.032.445-1.032 1.007v8.18c0 .563.446 1.031 1.032 1.031h8.156c.586 0 1.031-.468 1.031-1.031" />
                                    </svg>


                                    <h3 class="text-lg font-semibold text-gray-900">TTD (QR Code)</h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Unggah QR Code TTD {{ $hasQr ? '' : ' (wajib)' }}
                                        </label>
                                        <input type="file" name="ttd_qr" id="qr-input" accept="image/*"
                                            class="w-full text-sm text-gray-700" {{ $hasQr ? '' : 'required' }}>
                                        <p class="text-xs text-gray-500 mt-1">
                                            Format gambar didukung: JPG, JPEG, PNG, WEBP, BMP, GIF, SVG, TIF/TIFF. Maksimal
                                            2MB.
                                        </p>

                                        <div class="mt-4 flex items-center gap-3">
                                            <button type="button" id="delete-qr-btn"
                                                class="{{ $hasQr ? '' : 'hidden' }} px-3 py-2 border border-red-200 rounded-lg text-red-700 hover:bg-red-50">
                                                Hapus QR
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                                        <div
                                            class="w-full h-40 rounded-lg border border-dashed border-gray-300 flex items-center justify-center bg-gray-50 relative">
                                            <img id="qr-preview" src="{{ $qrUrl ?? '' }}" alt="Preview QR TTD"
                                                class="max-h-32 object-contain {{ $hasQr ? '' : 'hidden' }}">
                                            <div id="qr-fallback"
                                                class="hidden text-sm text-gray-500 absolute inset-x-0 text-center px-3">
                                                Pratinjau tidak tersedia untuk format ini, namun file tetap dapat disimpan.
                                            </div>
                                            <span id="qr-empty" class="text-sm text-gray-400 {{ $hasQr ? 'hidden' : '' }}">
                                                Belum ada QR Code
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="border-b pb-6">
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 11c1.657 0 3-1.567 3-3.5S13.657 4 12 4 9 5.567 9 7.5 10.343 11 12 11z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2" />
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-900">Informasi Akun</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                        Lengkap</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $user->name) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                </div>
                            </div>
                        </div>

                        @if ($showAcademic)
                            <div class="border-b pb-6">
                                <div class="flex items-center gap-2 mb-4">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l6.16-3.422A12.083 12.083 0 0112 20.055 12.083 12.083 0 015.84 10.578L12 14z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900">Informasi Akademik</h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-{{ $showProdi ? '3' : '2' }} gap-6">
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-2">{{ $idLabel }}</label>
                                        <input type="text" value="{{ $nimnip ?? '-' }}" readonly
                                            class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                                        <input type="text" value="{{ $jurusan ?? '-' }}" readonly
                                            class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                                    </div>
                                    @if ($showProdi)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Program
                                                Studi</label>
                                            <input type="text" value="{{ $prodi ?? '-' }}" readonly
                                                class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                                        </div>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500 mt-3">Informasi akademik dikelola oleh admin. Hubungi admin
                                    bila ada kesalahan.</p>
                            </div>
                        @endif

                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10V7a4 4 0 118 0v3m-9 0h10a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6a2 2 0 012-2z" />
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-900">Keamanan Akun</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                        Baru</label>
                                    <input type="password" name="password" id="password"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti password.
                                    </p>
                                </div>
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                    <p id="pwd-error" class="hidden text-xs text-red-600 mt-1">Kata sandi dan konfirmasi
                                        tidak sama.</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t">
                            <a href="{{ url()->previous() }}"
                                class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors text-center">
                                Batal
                            </a>
                            <button type="submit" id="submit-btn"
                                class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 transform focus:ring-2 focus:ring-red-200">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <aside class="space-y-6">
                    <div class="bg-white rounded-2xl p-6 card-shadow transition-transform hover:-translate-y-1.5">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-gray-900">Ringkasan Akun</h4>
                            <span
                                class="px-2 py-1 text-xs rounded-full {{ $user->status === 'active' ? 'status-approved' : 'status-pending' }}">
                                {{ $user->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-600 space-y-2">
                            <div class="flex justify-between">
                                <span>Role</span>
                                <span class="font-medium capitalize">{{ str_replace('_', ' ', $role) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Email</span>
                                <span class="font-medium truncate max-w-[150px]">{{ $user->email }}</span>
                            </div>
                            @if ($showAcademic)
                                <div class="flex justify-between">
                                    <span>{{ $idLabel }}</span>
                                    <span class="font-medium">{{ $nimnip ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Jurusan</span>
                                    <span class="font-medium truncate max-w-[150px]">{{ $jurusan ?? '-' }}</span>
                                </div>
                                @if ($showProdi)
                                    <div class="flex justify-between">
                                        <span>Prodi</span>
                                        <span class="font-medium truncate max-w-[150px]">{{ $prodi ?? '-' }}</span>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    @if ($needsQRCode)
                        <div class="bg-white rounded-2xl p-6 card-shadow transition-transform hover:-translate-y-1.5">
                            <h4 class="font-semibold text-gray-900 mb-3">Tips QR Code TTD</h4>
                            <ul class="text-sm text-gray-600 list-disc pl-5 space-y-2">
                                <li>Gunakan QR Code yang jelas dengan kontras tinggi (hitam di atas putih).</li>
                                <li>Pastikan ada <span class="font-medium">quiet zone</span> (margin kosong) di sekeliling
                                    QR.</li>
                                <li>Ukuran minimal disarankan <span class="font-medium">256×256 px</span>.</li>
                                <li>SVG tajam (vector), PNG/WEBP juga oke. Hindari blur/kompresi berlebihan.</li>
                                <li>Uji dengan pemindai sebelum digunakan di dokumen resmi.</li>
                            </ul>
                        </div>
                    @endif
                </aside>
            </div>
        </main>
    </div>

    <script>
        const qrInput = document.getElementById('qr-input');
        const qrPreview = document.getElementById('qr-preview');
        const qrEmpty = document.getElementById('qr-empty');
        const qrFallback = document.getElementById('qr-fallback');
        const delBtn = document.getElementById('delete-qr-btn');

        function showPreviewObjectURL(file) {
            const url = URL.createObjectURL(file);
            if (!qrPreview) return;

            qrPreview.onload = () => {
                qrPreview.classList.remove('hidden');
                qrFallback?.classList.add('hidden');
                qrEmpty?.classList.add('hidden');
            };
            qrPreview.onerror = () => {
                qrPreview.classList.add('hidden');
                qrFallback?.classList.remove('hidden');
                qrEmpty?.classList.add('hidden');
            };

            qrPreview.src = url;
            delBtn?.classList.add('hidden');
        }

        qrInput?.addEventListener('change', (e) => {
            const file = e.target.files && e.target.files[0];
            if (!file) return;
            showPreviewObjectURL(file);
        });

        delBtn?.addEventListener('click', async () => {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const res = await fetch("{{ route('profile.ttd_qr.destroy') }}", {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    }
                });

                const data = await res.json();

                if (!res.ok) {
                    if (typeof showSuccessMessage === 'function') {
                        showSuccessMessage(data.message || 'Gagal menghapus QR.', 'red');
                    } else {
                        alert(data.message || 'Gagal menghapus QR.');
                    }
                    return;
                }

                if (qrPreview) {
                    qrPreview.src = '';
                    qrPreview.classList.add('hidden');
                }
                qrEmpty?.classList.remove('hidden');
                qrFallback?.classList.add('hidden');
                delBtn.classList.add('hidden');
                if (qrInput) qrInput.value = '';

                if (typeof showSuccessMessage === 'function') {
                    showSuccessMessage(data.message || 'QR Code TTD berhasil dihapus.', 'green');
                }
            } catch (err) {
                if (typeof showSuccessMessage === 'function') {
                    showSuccessMessage('Kesalahan jaringan saat menghapus QR.', 'red');
                } else {
                    alert('Kesalahan jaringan saat menghapus QR.');
                }
                console.error(err);
            }
        });

        const pwd = document.getElementById('password');
        const conf = document.getElementById('password_confirmation');
        const submitBtn = document.getElementById('submit-btn');
        const pwdErr = document.getElementById('pwd-error');

        function validatePwd() {
            const p = (pwd?.value || '').trim();
            const c = (conf?.value || '').trim();

            if (p === '' && c === '') {
                pwdErr?.classList.add('hidden');
                if (submitBtn) submitBtn.disabled = false;
                return;
            }
            if (p !== c) {
                pwdErr?.classList.remove('hidden');
                if (submitBtn) submitBtn.disabled = true;
            } else {
                pwdErr?.classList.add('hidden');
                if (submitBtn) submitBtn.disabled = false;
            }
        }

        pwd?.addEventListener('input', validatePwd);
        conf?.addEventListener('input', validatePwd);
    </script>
@endsection
