@extends('layouts.dashboard.layout')
@section('title', 'Admin Jurusan | Template Surat')
@section('template-surat', 'active')

@section('content')
    <div class="lg:ml-64">
        <x-dashboard.topbar :title="'Dashboard'" />

        <main class="p-4 sm:p-6">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Template Surat</h2>
                <p class="text-gray-600 text-lg">Kelola template surat untuk departemen Anda dengan mudah.</p>
            </div>

            @verbatim
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Template 1: Surat Pernyataan -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col"
                        style="height: 600px;">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Surat Rekomendasi Magang</h3>
                                    <p class="text-blue-100">Template untuk surat pernyataan resmi</p>
                                </div>
                                <button onclick="copyTemplate('template1', 'Surat Pernyataan')"
                                    class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center copy-btn"
                                    data-template="template1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="ml-2">Salin</span>
                                </button>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col min-h-0">
                            <div class="bg-gray-50 border-l-4 border-blue-500 p-4 rounded-r-lg mb-4 flex-1 min-h-0">
                                <div
                                    class="h-full overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 pr-2">
                                    <div id="template1" class="font-mono text-sm text-gray-800 leading-relaxed whitespace-pre-wrap">Yang bertanda tangan di bawah ini:
Nama {{ SPASI_PENYELARAS }} {{ NAMA_DOSEN }}
Jabatan {{ SPASI_PENYELARAS }} {{ JABATAN }}

Memberikan rekomendasi kepada mahasiswa atas nama :
{{ DAFTAR_MAHASISWA }}

Untuk melaksanakan magang di {{ LOKASI }} selama {{ WAKTU }}
Demikian surat rekomendasi ini dibuat, untuk digunakan sebagaimana mestinya.
</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Template 2: Surat Keterangan Aktif Kuliah -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col"
                        style="height: 600px;">
                        <div class="bg-gradient-to-r from-green-600 to-green-700 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Surat Permohonan Survei/Pengambilan Data</h3>
                                    <p class="text-green-100">Template untuk keterangan mahasiswa aktif</p>
                                </div>
                                <button onclick="copyTemplate('template2', 'Surat Permohonan Survei/Pengambilan Data')"
                                    class="bg-green-100 hover:bg-green-200 text-green-700 px-4 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center copy-btn"
                                    data-template="template2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="ml-2">Salin</span>
                                </button>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col min-h-0">
                            <div class="bg-gray-50 border-l-4 border-green-500 p-4 rounded-r-lg mb-4 flex-1 min-h-0">
                                <div
                                    class="h-full overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 pr-2">
                                    <div id="template2"
                                        class="font-mono text-sm text-gray-800 leading-relaxed whitespace-pre-wrap">Untuk menunjang pelaksanaan perkuliahan pada mata kuliah {{ MATA_KULIAH }}, Jurusan Teknik Informatika, maka kami sangat mengharapkan kesediaan Bapak/Ibu kiranya dapat memberikan bantuan berupa petunjuk/bimbingan dan data-data kepada mahasiswa kami.
Nama mahasiswa sebagai berikut :
{{ DAFTAR_MAHASISWA }}

Atas bantuan dan kerjasama yang baik, kami ucapkan terima kasih.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endverbatim
        </main>
    </div>

    <div id="toast1"
        class="fixed top-4 right-4 p-4 bg-green-500 text-white rounded-lg shadow-lg transform translate-y-[-100px] transition-transform duration-300 z-50">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>Template berhasil disalin!</span>
        </div>
    </div>

    <script>
        function copyTemplate(templateId, templateName) {
            const templateElement = document.getElementById(templateId);
            const templateText = templateElement.textContent || templateElement.innerText;

            navigator.clipboard.writeText(templateText).then(() => {
                showToast(`Template ${templateName} berhasil disalin!`);
                const button = document.querySelector(`button[data-template="${templateId}"]`);
                const originalHtml = button.innerHTML;

                button.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="ml-2">Tersalin!</span>
                `;
                button.classList.remove('bg-blue-100', 'hover:bg-blue-200', 'text-blue-700');
                button.classList.add('bg-green-100', 'text-green-700');

                setTimeout(() => {
                    button.innerHTML = originalHtml;
                    button.classList.remove('bg-green-100', 'text-green-700');
                    button.classList.add('bg-blue-100', 'hover:bg-blue-200', 'text-blue-700');
                }, 2000);
            }).catch(err => {
                console.error('Gagal menyalin teks: ', err);
                alert('Gagal menyalin template. Silakan coba lagi.');
            });
        }
    </script>

    <style>
        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-thumb-gray-300::-webkit-scrollbar-thumb {
            background-color: #D1D5DB;
            border-radius: 3px;
        }

        .scrollbar-track-gray-100::-webkit-scrollbar-track {
            background-color: #F3F4F6;
        }

        .copy-btn {
            transition: all 0.3s ease;
        }

        .copy-btn:hover {
            transform: scale(1.05);
        }
    </style>
@endsection
