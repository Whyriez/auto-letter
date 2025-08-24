@extends('layouts.dashboard.layout')
@section('title', 'Kajur | Dashboard')
@section('kajur-dashboard', 'active')

@section('content')
    <div class="lg:ml-64">
        <x-dashboard.topbar :title="'Dashboard'" />

        <main class="p-4 sm:p-6">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang, {{ Auth::user()->name }}</h2>
                <p class="text-gray-600">Tinjau dan setujui permintaan surat yang tertunda dari departemen Anda.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $pendingCount }}</p>
                            <p class="text-sm text-gray-600">Permintaan Tertunda</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $approvedTodayCount }}</p>
                            <p class="text-sm text-gray-600">Disetujui Hari Ini</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalThisMonthCount }}</p>
                            <p class="text-sm text-gray-600">Total Bulan Ini</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow mb-6">
                <form id="filter-form" method="GET" action="{{ route('kajur.index') }}">
                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                        <div class="flex flex-col sm:flex-row gap-4 flex-1">
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input type="text" name="search" placeholder="Cari berdasarkan nama mahasiswa..."
                                    value="{{ request('search') }}"
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 w-full sm:w-64">
                            </div>
                            <div class="flex gap-2">

                                <select name="letter_template"
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                    <option value="">Semua Tipe Surat</option>
                                    @foreach ($letterTemplates as $template)
                                        <option value="{{ $template->id }}"
                                            {{ request('letter_template') == $template->id ? 'selected' : '' }}>
                                            {{ $template->nama_surat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                Filter
                            </button>
                            <a href="{{ route('kajur.index') }}"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl card-shadow overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h3 class="text-lg font-semibold text-red-900">Permintaan Persetujuan Tertunda</h3>
                    <p class="text-sm text-red-700 mt-1">Meninjau dan menyetujui permintaan surat dari siswa</p>
                </div>

                <div class="desktop-table overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mahasiswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tipe Surat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal Permintaan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tenggat waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($pendingRequests as $request)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-blue-600 font-semibold text-sm">
                                                    {{ Str::substr($request->user->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $request->user->name }}</div>
                                                <div class="text-sm text-gray-500">NIM: {{ $request->user->nim_nip }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $request->letterTemplate->nama_surat }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $request->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($request->needed_at)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="{{ route('kajur.preview', ['id' => $request->id]) }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">
                                            Lihat Detail
                                        </a>
                                        <a href="{{ route('kajur.approveAndExportPdf', ['id' => $request->id]) }}"
                                            class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-lg transition-colors">
                                            Setujui
                                        </a>
                                        <a href="#" data-url="{{ route('kajur.rejected', $request->id) }}"
                                            class="reject-btn text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg transition-colors">Tolak</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada permintaan surat yang belum di-approve.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mobile-cards p-4 space-y-4">
                    @forelse ($pendingRequests as $request)
                        <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-blue-600 font-semibold text-sm">
                                            {{ Str::substr($request->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $request->user->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">NIM: {{ $request->user->nim_nip }}</div>
                                    </div>
                                </div>
                                <span class="status-urgent px-2 py-1 rounded-full text-xs font-medium">Urgent</span>
                            </div>
                            <div class="space-y-2 text-sm mb-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tipe Surat:</span>
                                    <span
                                        class="text-gray-900 font-medium">{{ $request->letterTemplate->nama_surat }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tanggal Permintaan:</span>
                                    <span class="text-gray-900">{{ $request->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tenggat waktu:</span>
                                    <span
                                        class="text-gray-900">{{ \Carbon\Carbon::parse($request->needed_at)->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('kajur.preview', ['id' => $request->id]) }}" target="_blank"
                                    class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                                    Lihat Detail
                                </a>
                                <a href="{{ route('kajur.approveAndExportPdf', ['id' => $request->id]) }}"
                                    target="_blank"
                                    class="flex-1 text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                                    Setujui
                                </a>
                                <a href="#" data-url="{{ route('kajur.rejected', $request->id) }}"
                                    class="reject-btn flex-1 text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                                    Tolak
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6">
                            <p class="text-gray-500">Tidak ada permintaan surat yang belum di-approve.</p>
                        </div>
                    @endforelse
                </div>

                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                    @if ($pendingRequests->hasPages())
                        {{ $pendingRequests->links('components.paging.custom-pagination') }}
                    @endif
                </div>
            </div>
        </main>
    </div>

    <x-rejected-form-modal />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rejectButtons = document.querySelectorAll('.reject-btn');
            const rejectModal = document.getElementById('reject-modal');

            rejectButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.dataset.url;
                    openRejectModal(url);
                });
            });

            window.addEventListener('click', function(e) {
                if (e.target === rejectModal) {
                    closeRejectModal();
                }
            });
        });
    </script>
@endsection
