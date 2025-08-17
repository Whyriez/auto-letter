@extends('layouts.dashboard.layout')
@section('title', 'Admin Jurusan | Dashboard')
@section('admin-jurusan-dashboard', 'active')



@section('content')
    <div class="lg:ml-64">
        <!-- Top Bar -->
        <x-dashboard.topbar :title="'Dashboard'" />

        <!-- Dashboard Content -->
        <main class="p-4 sm:p-6">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Dashboard Super Admin</h2>
                <p class="text-gray-600">teseting</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl p-6 card-shadow transition-transform duration-200 hover:-translate-y-1.5">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-1a6 6 0 00-9-5.197M9 20H4v-1a6 6 0 019-5.197M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">123</p>
                            <p class="text-sm text-gray-600">Total Mahasiswa</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow transition-transform duration-200 hover:-translate-y-1.5">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">123</p>
                            <p class="text-sm text-gray-600">Pengguna Aktif</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow transition-transform duration-200 hover:-translate-y-1.5">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">12</p>
                            <p class="text-sm text-gray-600">Pengguna Tidak Aktif</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow transition-transform duration-200 hover:-translate-y-1.5">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" />
                                <line x1="8" y1="8" x2="16" y2="16" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" />
                                <line x1="16" y1="8" x2="8" y2="16" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">123</p>
                            <p class="text-sm text-gray-600">Pengguna Diblokir</p>
                        </div>
                    </div>
                </div>
            </div>



        </main>
    </div>

@endsection
