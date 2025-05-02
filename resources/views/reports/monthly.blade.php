@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('profile') }}" class="btn btn-secondary">Back</a>
</div>
<div class="container">
    <h2 class="mb-4">Monthly Expense Report</h2>

    <!-- Form to select month and year -->
    <form action="{{ route('reports.monthly') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <label for="month" class="form-label">Select Month</label>
            <select name="month" id="month" class="form-select">
                @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}" {{ $m == request('month') ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="year" class="form-label">Select Year</label>
            <select name="year" id="year" class="form-select">
                @foreach(range(now()->year - 5, now()->year) as $y)
                    <option value="{{ $y }}" {{ $y == request('year') ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary mt-2">Generate Report</button>
        </div>
    </form>

    @if(request('month') && request('year'))
        <!-- Download Report Link -->
        <div class="text-end mb-3">
            <a class="btn btn-outline-primary" href="{{ route('reports.downloadPdf', ['month' => request('month'), 'year' => request('year')]) }}">Download Report</a>
        </div>

        <!-- Chart Display -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Expenses by Category</h5>
                <div style="position: relative; height:60vh; width:100%;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Displaying Grand Total -->
        <div class="mt-3">
            <h5><strong>Grand Total:  ${{ number_format($grandTotal, 2) }}</strong></h5>
        </div>
    @endif
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if(request('month') && request('year'))
<script>
    const labels = @json(array_keys($categoryData->toArray()));
    const data = @json(array_values($categoryData->toArray()));

    new Chart(document.getElementById('categoryChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Expenses by Category (in ₹)',
                data: data,
                backgroundColor: 'rgba(255, 102, 232, 0.6)',
                borderColor: 'rgb(255, 102, 232)',
                borderWidth: 1,
                borderRadius: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    },
                    title: {
                        display: true,
                        text: 'Amount'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Categories'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: (ctx) => `₹ ${ctx.raw}`
                    }
                }
            }
        }
    });
</script>
@endif
@endsection
