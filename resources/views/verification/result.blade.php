<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Dokumen - AutoLetter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .card-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .logo-text {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .status-animation {
            animation: statusPulse 2s infinite;
        }

        @keyframes statusPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .success-gradient {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .error-gradient {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .info-card {
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .hash-display {
            word-break: break-all;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-left: 4px solid #3b82f6;
        }

        .verification-icon {
            background: conic-gradient(from 180deg, #10b981, #3b82f6, #8b5cf6, #10b981);
            padding: 3px;
            border-radius: 50%;
        }

        .verification-icon-inner {
            background: white;
            border-radius: 50%;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <!-- Header dengan Logo -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold logo-text">AutoLetter</span>
                    <span class="ml-4 text-gray-400">|</span>
                    <span class="ml-4 text-gray-600 font-medium">Sistem Verifikasi Dokumen</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            
            <!-- Status Card -->
            <div class="bg-white rounded-2xl card-shadow overflow-hidden mb-8">
                <!-- Header with verification icon -->
                <div class="bg-gradient-to-r from-red-50 to-red-100 px-6 sm:px-8 py-6">
                    <div class="flex items-center">
                        <div class="verification-icon w-16 h-16 mr-4">
                            <div class="verification-icon-inner">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Verifikasi Dokumen</h1>
                            <p class="text-gray-600 mt-1">Sistem verifikasi blockchain AutoLetter</p>
                        </div>
                    </div>
                </div>

                <!-- Status Result -->
                <div class="p-6 sm:p-8">
                    @if ($status === 'valid')
                        <!-- Valid Status -->
                        <div class="flex items-start space-x-4">
                            <div class="success-gradient w-16 h-16 rounded-full flex items-center justify-center status-animation">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-green-700 mb-2">✅ Dokumen Terverifikasi</h2>
                                <p class="text-green-600 text-lg mb-4">
                                    Dokumen ini resmi dan telah disetujui oleh sistem AutoLetter
                                </p>
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <p class="text-green-800 font-medium">
                                        Status: <span class="font-bold">VALID</span> • 
                                        Integritas: <span class="font-bold">TERJAMIN</span> •
                                        Blockchain: <span class="font-bold">VERIFIED</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @elseif ($status === 'mismatched')
                        <!-- Mismatched Status -->
                        <div class="flex items-start space-x-4">
                            <div class="error-gradient w-16 h-16 rounded-full flex items-center justify-center status-animation">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-red-700 mb-2">❌ {{ $message }}</h2>
                                <p class="text-red-600 text-lg mb-4">
                                    Dokumen yang tersimpan di sistem tidak cocok dengan hash yang terdaftar.
                                </p>
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                    <p class="text-red-800 font-medium">
                                        Status: <span class="font-bold">MISMATCHED</span> • 
                                        Integritas: <span class="font-bold">BERMASALAH</span> •
                                        Blockchain: <span class="font-bold">HASH CONFLICT</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Invalid/Error Status -->
                        <div class="flex items-start space-x-4">
                            <div class="error-gradient w-16 h-16 rounded-full flex items-center justify-center status-animation">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-red-700 mb-2">❌ {{ $message }}</h2>
                                <p class="text-red-600 text-lg mb-4">
                                    Dokumen ini tidak dapat diverifikasi atau tidak ditemukan dalam sistem
                                </p>
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                    <p class="text-red-800 font-medium">
                                        Status: <span class="font-bold">INVALID</span> • 
                                        Integritas: <span class="font-bold">TIDAK DAPAT DIVERIFIKASI</span> •
                                        Blockchain: <span class="font-bold">NOT FOUND</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if ($status === 'valid')
                <!-- Document Details Card (only for valid documents) -->
                <div class="bg-white rounded-2xl card-shadow overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 sm:px-8 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Detail Dokumen
                        </h3>
                    </div>
                    
                    <div class="p-6 sm:p-8">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="info-card bg-gray-50 rounded-xl p-5">
                                <div class="flex items-center mb-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-500">Jenis Surat</p>
                                </div>
                                <p class="text-lg font-semibold text-gray-900">{{ $letter->letterTemplate->nama_surat ?? 'Tidak Diketahui' }}</p>
                            </div>

                            <div class="info-card bg-gray-50 rounded-xl p-5">
                                <div class="flex items-center mb-3">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-500">Nomor Surat</p>
                                </div>
                                <p class="text-lg font-semibold text-gray-900">{{ $letter->nomor_surat }}</p>
                            </div>

                            <div class="info-card bg-gray-50 rounded-xl p-5">
                                <div class="flex items-center mb-3">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m0 0V7a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V9a2 2 0 012-2v0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-500">Tanggal Permintaan</p>
                                </div>
                                <p class="text-lg font-semibold text-gray-900">{{ $letter->created_at->format('M d, Y') }}</p>
                            </div>

                            <div class="info-card bg-gray-50 rounded-xl p-5">
                                <div class="flex items-center mb-3">
                                    <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-500">Status Keamanan</p>
                                </div>
                                <p class="text-lg font-semibold text-green-600">Blockchain Verified</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blockchain Hash Card -->
                <div class="bg-white rounded-2xl card-shadow overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 px-6 sm:px-8 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14-7H3a1 1 0 00-1 1v11a1 1 0 001 1h16a1 1 0 001-1V5a1 1 0 00-1-1zM9 7h6"></path>
                            </svg>
                            Hash Blockchain
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Fingerprint kriptografi dokumen</p>
                    </div>
                    
                    <div class="p-6 sm:p-8">
                        <div class="hash-display rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Document Hash (SHA-256)</p>
                                    <p class="text-xs text-gray-400">Unique cryptographic fingerprint</p>
                                </div>
                            </div>
                            <code class="text-sm font-mono text-gray-700 bg-white p-3 rounded-lg block leading-relaxed">
                                {{ $letter->blockchain_hash }}
                            </code>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center text-xs text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                    Hash ini memastikan dokumen tidak pernah diubah
                                </div>
                                <button onclick="copyHash('{{ $letter->blockchain_hash }}')" class="text-blue-600 hover:text-blue-800 text-xs font-medium bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">
                                    Copy Hash
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @if ($status === 'valid')
                    <a href="{{ $documentUrl }}" target="_blank" class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-green-200 card-shadow text-center">
                        <div class="flex items-center justify-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Unduh Dokumen Resmi
                        </div>
                    </a>
                @endif
                
                <button onclick="window.history.back()" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-200 card-shadow">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18">
                            </path>
                        </svg>
                        Kembali
                    </div>
                </button>
            </div>

            <!-- Footer Info -->
            <div class="text-center mt-12 text-gray-500">
                <p class="text-sm">
                    Sistem verifikasi ini menggunakan teknologi blockchain untuk memastikan keaslian dokumen.
                </p>
                <p class="text-xs mt-2">
                    © 2024 AutoLetter - Universitas Sam Ratulangi
                </p>
            </div>
        </div>
    </div>

    <script>
        function copyHash(hashText) {
            navigator.clipboard.writeText(hashText).then(() => {
                showNotification('Hash berhasil disalin!', 'success');
            });
        }

        function showNotification(message, type = 'success') {
            const colors = {
                success: 'from-green-500 to-green-600',
                error: 'from-red-500 to-red-600',
                info: 'from-blue-500 to-blue-600'
            };

            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 bg-gradient-to-r ${colors[type]} text-white px-6 py-4 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    ${message}
                </div>
            `;
            document.body.appendChild(notification);

            setTimeout(() => notification.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => document.body.removeChild(notification), 300);
            }, 3000);
        }
    </script>
</body>

</html>