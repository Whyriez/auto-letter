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
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome back, John!</h2>
                <p class="text-gray-600">Manage your recommendation letters and track their progress.</p>
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
                        Request New Letter
                    </div>
                </button>
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

            <!-- My Letter History -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">My Letter History</h3>
                    <button onclick="showDemo()" class="text-red-600 hover:text-red-700 font-medium text-sm">View
                        All</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <!-- Letter Card 1 -->
                    <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer"
                        onclick="showDemo()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">Graduate School Application</h4>
                                <p class="text-sm text-gray-600">Prof. Sarah Johnson</p>
                            </div>
                            <span class="status-approved px-2 py-1 rounded-full text-xs font-medium">Approved</span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>Dec 15, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Deadline:</span>
                                <span>Jan 15, 2024</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Institution:</span>
                                <span>MIT</span>
                            </div>
                        </div>
                    </div>

                    <!-- Letter Card 2 -->
                    <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer"
                        onclick="showDemo()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">Research Internship</h4>
                                <p class="text-sm text-gray-600">Dr. Michael Chen</p>
                            </div>
                            <span class="status-pending px-2 py-1 rounded-full text-xs font-medium">Pending</span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>Dec 20, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Deadline:</span>
                                <span>Feb 1, 2024</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Company:</span>
                                <span>Google Research</span>
                            </div>
                        </div>
                    </div>

                    <!-- Letter Card 3 -->
                    <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer"
                        onclick="showDemo()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">Scholarship Application</h4>
                                <p class="text-sm text-gray-600">Prof. Emily Davis</p>
                            </div>
                            <span class="status-approved px-2 py-1 rounded-full text-xs font-medium">Approved</span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>Nov 30, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Deadline:</span>
                                <span>Dec 31, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Organization:</span>
                                <span>NSF Fellowship</span>
                            </div>
                        </div>
                    </div>

                    <!-- Letter Card 4 -->
                    <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer"
                        onclick="showDemo()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">Job Application</h4>
                                <p class="text-sm text-gray-600">Prof. Robert Wilson</p>
                            </div>
                            <span class="status-pending px-2 py-1 rounded-full text-xs font-medium">Pending</span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>Dec 18, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Deadline:</span>
                                <span>Jan 30, 2024</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Company:</span>
                                <span>Microsoft</span>
                            </div>
                        </div>
                    </div>

                    <!-- Letter Card 5 -->
                    <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer"
                        onclick="showDemo()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">PhD Program</h4>
                                <p class="text-sm text-gray-600">Dr. Lisa Anderson</p>
                            </div>
                            <span class="status-draft px-2 py-1 rounded-full text-xs font-medium">Draft</span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>Dec 22, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Deadline:</span>
                                <span>Mar 1, 2024</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Institution:</span>
                                <span>Stanford</span>
                            </div>
                        </div>
                    </div>

                    <!-- Letter Card 6 -->
                    <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer"
                        onclick="showDemo()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">Summer Program</h4>
                                <p class="text-sm text-gray-600">Prof. James Taylor</p>
                            </div>
                            <span class="status-approved px-2 py-1 rounded-full text-xs font-medium">Approved</span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>Nov 25, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Deadline:</span>
                                <span>Dec 15, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Program:</span>
                                <span>REU Program</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- New Letter Request Modal -->
    <div id="letter-modal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Formulir Permintaan Surat</h2>
                <button onclick="closeLetterModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="p-6 space-y-6" onsubmit="handleLetterSubmit(event)">
                <!-- Letter Type Dropdown -->
                <div>
                    <label for="letter-type" class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Jenis Surat <span class="text-red-500">*</span>
                    </label>
                    <select id="letter-type" name="letter-type" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                        <option value="">-- Pilih Jenis Surat --</option>
                        <option value="surat-aktif-kuliah">Surat Aktif Kuliah</option>
                        <option value="izin-penelitian">Izin Penelitian</option>
                        <option value="surat-rekomendasi">Surat Rekomendasi</option>
                        <option value="surat-keterangan">Surat Keterangan</option>
                        <option value="surat-magang">Surat Magang</option>
                        <option value="surat-cuti">Surat Cuti Akademik</option>
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
                        <input type="text" id="full-name" name="full-name" value="John Smith" readonly
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                    </div>

                    <!-- Student ID -->
                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-600 mb-1">
                            NIM
                        </label>
                        <input type="text" id="nim" name="nim" value="12345678" readonly
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                    </div>

                    <!-- Program Study -->
                    <div>
                        <label for="program-study" class="block text-sm font-medium text-gray-600 mb-1">
                            Program Studi
                        </label>
                        <input type="text" id="program-study" name="program-study" value="Teknik Informatika"
                            readonly
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                    </div>

                    <!-- Faculty -->
                    <div>
                        <label for="faculty" class="block text-sm font-medium text-gray-600 mb-1">
                            Fakultas
                        </label>
                        <input type="text" id="faculty" name="faculty" value="Fakultas Teknik" readonly
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                    </div>

                    <!-- Semester -->
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-600 mb-1">
                            Semester
                        </label>
                        <input type="text" id="semester" name="semester" value="7" readonly
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
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

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="button" onclick="closeLetterModal()"
                        class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-200">
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
