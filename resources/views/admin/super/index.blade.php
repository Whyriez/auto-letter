@extends('layouts.dashboard.layout')
@section('title', 'Super Admin | Dashboard')
@section('dashboard', 'active')



@section('content')
    <div class="lg:ml-64">
        <x-dashboard.topbar :title="'Dashboard'" />

        <main class="p-4 sm:p-6">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Dashboard Super Admin</h2>
                <p class="text-gray-600">Hallo, {{ Auth::user()->name }}</p>
            </div>

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
                            <p class="text-2xl font-bold text-gray-900">{{ $totalMahasiswa }}</p>
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
                            <p class="text-2xl font-bold text-gray-900">{{ $totalActiveUsers }}</p>
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
                            <p class="text-2xl font-bold text-gray-900">{{ $totalInactiveUsers }}</p>
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
                            <p class="text-2xl font-bold text-gray-900">{{ $totalSuspendedUsers }}</p>
                            <p class="text-sm text-gray-600">Pengguna Diblokir</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow card-hover">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Status Pengguna</h3>
                    </div>
                    <div id="echarts-donut-status" class="w-full h-80"></div>
                </div>

                <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow card-hover">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Distribusi Role (Bar)</h3>
                    </div>
                    <div id="echarts-bar-roles" class="w-full h-80"></div>
                </div>
            </div>



        </main>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

@push('charts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const donutEl = document.getElementById('echarts-donut-status');
            if (donutEl && window.echarts) {
                const donutChart = echarts.init(donutEl);

                const active = Number({{ $totalActiveUsers ?? 0 }});
                const inactive = Number({{ $totalInactiveUsers ?? 0 }});
                const suspended = Number({{ $totalSuspendedUsers ?? 0 }});

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
                    color: ['#16a34a', '#f59e0b', '#ef4444'],
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
                            formatter: '{b}', 
                            fontSize: 11,
                            color: '#374151',
                            distanceToLabelLine: 2 
                        },
                        labelLine: {
                            show: true,
                            length: 20, 
                            length2: 22, 
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
                        data: [{
                                value: active,
                                name: 'Aktif'
                            },
                            {
                                value: inactive,
                                name: 'Tidak Aktif'
                            },
                            {
                                value: suspended,
                                name: 'Diblokir'
                            }
                        ]
                    }]
                };


                donutChart.setOption(donutOption);
                window.addEventListener('resize', () => donutChart.resize());
            }

            (function() {
                const el = document.getElementById('echarts-bar-roles');
                if (!el || typeof echarts === 'undefined') return;

                const chart = echarts.init(el);

                const roleCounts = @json($roleCounts ?? []);

                const labelMap = {
                    mahasiswa: 'Mahasiswa',
                    admin_jurusan: 'Admin Jurusan',
                    kaprodi: 'Kaprodi',
                    kajur: 'Kajur',
                };

                const roles = Object.keys(roleCounts);
                const labels = roles.map(r => labelMap[r] ?? r);
                const values = roles.map(r => roleCounts[r] ?? 0);

                const colorMap = {
                    mahasiswa: '#3b82f6', 
                    admin_jurusan: '#10b981', 
                    kaprodi: '#f59e0b', 
                    kajur: '#ef4444', 
                };

                const option = {
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        }
                    },
                    grid: {
                        top: 24,
                        left: 44,
                        right: 16,
                        bottom: 40
                    },
                    xAxis: {
                        type: 'category',
                        data: labels,
                        axisTick: {
                            show: false
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#e5e7eb'
                            }
                        }, 
                        axisLabel: {
                            color: '#6b7280',
                            fontSize: 12,
                            interval: 0
                        } 
                    },
                    yAxis: {
                        type: 'value',
                        splitLine: {
                            lineStyle: {
                                color: '#f1f5f9'
                            }
                        }, 
                        axisLabel: {
                            color: '#6b7280',
                            fontSize: 12
                        }
                    },
                    series: [{
                        type: 'bar',
                        barMaxWidth: 46,
                        label: {
                            show: true,
                            position: 'top',
                            color: '#374151',
                            fontSize: 12
                        },
                        emphasis: {
                            focus: 'series',
                            itemStyle: {
                                shadowBlur: 12,
                                shadowColor: 'rgba(0,0,0,.12)'
                            }
                        },
                        data: values.map((v, i) => ({
                            value: v,
                            itemStyle: {
                                color: colorMap[roles[i]] ||
                                    '#94a3b8',
                                borderRadius: [6, 6, 0, 0]
                            }
                        }))
                    }]
                };

                chart.setOption(option);
                window.addEventListener('resize', () => chart.resize());
            })();
        });
    </script>
@endpush
