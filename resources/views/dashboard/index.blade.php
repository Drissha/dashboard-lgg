@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
</div>

<div class="grid md:grid-cols-3 gap-6 mb-8">

    <div class="card">
        <div class="card-body">
            <p class="text-gray-500 text-sm font-medium mb-2">Total Pages</p>
            <p class="text-3xl font-semibold text-gray-900">{{ $totalPages }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p class="text-gray-500 text-sm font-medium mb-2">Total Products</p>
            <p class="text-3xl font-semibold text-gray-900">{{ $totalProducts }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p class="text-gray-500 text-sm font-medium mb-2">Total Locations</p>
            <p class="text-3xl font-semibold text-gray-900">{{ $totalLocations }}</p>
        </div>
    </div>

</div>

<div class="card">
    <div class="card-header">
        <h3 class="text-lg font-semibold">Overview</h3>
    </div>
    <div class="card-body">
        <canvas id="dashboardChart" style="max-height: 400px;"></canvas>
    </div>
</div>

<script>
    // Wait for Chart.js to be loaded
    function initChart() {
        if (typeof Chart === 'undefined') {
            setTimeout(initChart, 100);
            return;
        }

        new Chart(
            document.getElementById('dashboardChart'),
            {
                type:'bar',
                data:{
                    labels:['Pages', 'Products', 'Locations'],
                    datasets:[{
                        label: 'Count',
                        data:[
                            {{ $totalPages }},
                            {{ $totalProducts }},
                            {{ $totalLocations }}
                        ],
                        backgroundColor: '#3b82f6',
                        borderRadius: 4,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            border: { display: false },
                            grid: { color: '#e5e7eb' }
                        },
                        x: {
                            border: { display: false },
                            grid: { display: false }
                        }
                    }
                }
            }
        );
    }

    // Initialize chart when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initChart);
    } else {
        initChart();
    }
</script>

@endsection