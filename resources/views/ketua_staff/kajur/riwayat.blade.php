@extends('layouts.dashboard.layout')
@section('title', 'Kajur | Riwayat Persetujuan')
@section('kajur-riwayat', 'active')

@section('content')
    <div class="lg:ml-64">
        <x-dashboard.topbar :title="'Dashboard'" />

        <main class="p-4 sm:p-6">
            <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow mb-6">
                <form id="filter-form" method="GET" action="{{ route('kajur.riwayat') }}">
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
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 bg-gray-50"> {{-- Warna diubah menjadi netral --}}
                    <h3 class="text-lg font-semibold text-gray-900">Riwayat Persetujuan</h3>
                    <p class="text-sm text-gray-700 mt-1">Daftar surat mahasiswa yang telah disetujui atau ditolak</p>
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
                                    Tanggal Diproses</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- [MODIFIKASI] Loop menggunakan $historyRequests --}}
                            @forelse ($historyRequests as $request)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <span
                                                    class="text-blue-600 font-semibold text-sm">{{ Str::substr($request->user->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $request->user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">NIM: {{ $request->user->nim_nip }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $request->letterTemplate->nama_surat }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $request->updated_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($request->status == 'completed')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Disetujui
                                            </span>
                                        @elseif ($request->status == 'rejected')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if ($request->status == 'completed' && $request->final_document_path)
                                            <a href="{{ asset('storage/' . $request->final_document_path) }}"
                                                target="_blank"
                                                class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">
                                                Lihat Surat
                                            </a>
                                        @else
                                            <a href="{{ route('kajur.preview', ['id' => $request->id]) }}"
                                                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 px-3 py-1 rounded-lg transition-colors">
                                                Lihat Detail
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada riwayat persetujuan yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mobile-cards p-4 space-y-4">
                    @forelse ($historyRequests as $request)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <span
                                            class="text-blue-600 font-semibold text-sm">{{ Str::substr($request->user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $request->user->name }}</div>
                                        <div class="text-xs text-gray-500">NIM: {{ $request->user->nim_nip }}</div>
                                    </div>
                                </div>
                                {{-- Status Badge untuk mobile --}}
                                @if ($request->status == 'completed')
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                                @elseif ($request->status == 'rejected')
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                @endif
                            </div>
                            <div class="space-y-2 text-sm mb-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tipe Surat:</span>
                                    <span
                                        class="text-gray-900 font-medium">{{ $request->letterTemplate->nama_surat }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tanggal Diproses:</span>
                                    <span class="text-gray-900">{{ $request->updated_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class="flex">
                                @if ($request->status == 'completed' && $request->final_document_path)
                                    <a href="{{ asset('storage/' . $request->final_document_path) }}" target="_blank"
                                        class="flex-1 text-center text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                                        Lihat Surat
                                    </a>
                                @else
                                    <a href="{{ route('kajur.preview', ['id' => $request->id]) }}"
                                        class="flex-1 text-center text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                                        Lihat Detail
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6">
                            <p class="text-gray-500">Tidak ada riwayat persetujuan yang ditemukan.</p>
                        </div>
                    @endforelse
                </div>

                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                    @if ($historyRequests->hasPages())
                        {{ $historyRequests->links('components.paging.custom-pagination') }}
                    @endif
                </div>
            </div>
        </main>
    </div>
@endsection
