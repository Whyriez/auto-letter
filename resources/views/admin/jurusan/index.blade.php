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
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Dashboard Admin Jurusan</h2>
                <p class="text-gray-600">Hallo, {{ Auth::user()->name }}</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalTemplates }}</p>
                            <p class="text-sm text-gray-600">Total Template</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $activeTemplates }}</p>
                            <p class="text-sm text-gray-600">Template Aktif</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $draftTemplates }}</p>
                            <p class="text-sm text-gray-600">Template Draf</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $timesUsed }}</p>
                            <p class="text-sm text-gray-600">Total Surat yang Digunakan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts: Admin Jurusan -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Donut: Status Template -->
                <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Distribusi Status Template</h3>
                        <span class="text-xs text-gray-500">Donut • ECharts</span>
                    </div>
                    <div id="echarts-aj-donut" class="w-full h-80"></div>
                </div>

                <!-- Bar Horizontal: Template per Jenis Surat -->
                <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Template per Jenis Surat</h3>
                        <span class="text-xs text-gray-500">Bar • ECharts</span>
                    </div>
                    <div id="echarts-aj-bar" class="w-full h-80"></div>
                </div>
            </div>


        </main>
    </div>
@endsection

@push('charts')
    <script>
        (function() {
            // ===== Donut: Status Template =====
            const elDonut = document.getElementById('echarts-aj-donut');
            if (elDonut && window.echarts) {
                const donut = echarts.init(elDonut);

                const statusCounts = @json($statusCounts ?? []);
                console.log(statusCounts);
                const dataDonut = [{
                        value: statusCounts.Active ?? 0,
                        name: 'Aktif'
                    },
                    {
                        value: statusCounts.Draft ?? 0,
                        name: 'Draft'
                    },
                    {
                        value: statusCounts.Archived ?? 0,
                        name: 'Arsip'
                    },
                ];

                const donutOption = {
                    tooltip: {
                        trigger: 'item'
                    },
                    legend: {
                        bottom: 0,
                        left: 'left',
                        orient: 'horizontal',
                        itemWidth: 14,
                        itemHeight: 14,
                        textStyle: {
                            color: '#374151',
                            fontSize: 12
                        }
                    },
                    color: ['#16a34a', '#f59e0b', '#64748b'],
                    series: [{
                        name: 'Status',
                        type: 'pie',
                        radius: ['48%', '72%'],
                        center: ['58%', '48%'],
                        avoidLabelOverlap: true,
                        padAngle: 2,
                        itemStyle: {
                            borderColor: '#fff',
                            borderWidth: 3,
                            borderRadius: 6
                        },
                        label: {
                            show: true,
                            position: 'outside',
                            formatter: '{b}', // hanya nama
                            fontSize: 11,
                            color: '#374151',
                            distanceToLabelLine: 2 // dekati garis
                        },
                        labelLine: {
                            show: true,
                            length: 20, // segmen 1 (dari slice)
                            length2: 22, // segmen mendatar
                            smooth: 0,
                            maxSurfaceAngle: 80
                        },

                        emphasis: {
                            scale: true,
                            focus: 'self',
                            itemStyle: {
                                shadowBlur: 1,
                                shadowColor: 'rgba(0,0,0,0.15)'
                            },
                            label: {
                                show: true,
                                fontWeight: 600
                            }
                        },
                        data: dataDonut
                    }]
                };

                donut.setOption(donutOption);
                window.addEventListener('resize', () => donut.resize());
            }

            // ===== Bar Horizontal: Template per Jenis Surat =====
            const elBar = document.getElementById('echarts-aj-bar');
            if (elBar && window.echarts) {
                const bar = echarts.init(elBar);
                const labels = @json($typeLabels ?? []);
                const values = @json($typeValues ?? []);

                const barOption = {
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        },
                        formatter: (params) => {
                            const p = Array.isArray(params) ? params[0] : params;
                            // p.name = label kategori (asli, bukan yang di-wrap oleh formatter)
                            return `${p.name}<br/>Jumlah: ${p.value}`;
                        }
                    },
                    grid: {
                        top: 12,
                        left: 8, // kecil saja
                        right: 16,
                        bottom: 28,
                        containLabel: true // ⬅️ biar label nggak kepotong
                    },
                    xAxis: {
                        type: 'value',
                        axisLabel: {
                            color: '#6b7280'
                        },
                        splitLine: {
                            lineStyle: {
                                color: '#f1f5f9'
                            }
                        }
                    },
                    yAxis: {
                        type: 'category',
                        data: labels, // tetap pakai label asli
                        axisTick: {
                            show: false
                        },
                        axisLabel: {
                            color: '#374151',
                            margin: 10,
                            formatter: (value) => wrapLabel(value, 16) // ⬅️ bungkus tiap 16 karakter
                        }
                    },
                    series: [{
                        type: 'bar',
                        data: values,
                        barMaxWidth: 28,
                        label: {
                            show: true,
                            position: 'right',
                            color: '#111827',
                            fontSize: 12
                        },
                        itemStyle: {
                            borderRadius: [6, 6, 6, 6],
                            color: (p) => {
                                const palette = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6',
                                    '#14b8a6', '#f97316'
                                ];
                                return palette[p.dataIndex % palette.length];
                            }
                        },
                        emphasis: {
                            focus: 'series'
                        }
                    }]
                };

                // helper: bungkus string jadi beberapa baris
                function wrapLabel(text, max = 16) {
                    if (!text) return '';
                    const parts = String(text).match(new RegExp(`.{1,${max}}`, 'g')) || [text];
                    return parts.join('\n');
                }


                bar.setOption(barOption);
                window.addEventListener('resize', () => bar.resize());
            }
        })();
    </script>
@endpush
