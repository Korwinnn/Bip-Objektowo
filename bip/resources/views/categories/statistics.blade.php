@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Statystyki odwiedzin</h2>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="categorySelect" class="form-label">Wybierz kategorię (opcjonalnie):</label>
                <select id="categorySelect" class="form-select">
                    <option value="">Wszystkie kategorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $selectedCategoryId ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="yearSelect" class="form-label">Wybierz rok:</label>
                <select id="yearSelect" class="form-select">
                    @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <!-- Wykres miesięczny -->
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Statystyki miesięczne {{ $selectedYear }}</h3>
                    </div>
                    <div class="card-body">
                        <div id="monthlyChart"></div>
                    </div>
                </div>
            </div>

            <!-- Wykres dzienny -->
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Statystyki dzienne ({{ now()->format('F Y') }})</h3>
                    </div>
                    <div class="card-body">
                        <div id="dailyChart"></div>
                    </div>
                </div>
            </div>

            <!-- Wykres godzinowy -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Statystyki godzinowe ({{ now()->format('d F Y') }})</h3>
                    </div>
                    <div class="card-body">
                        <div id="hourlyChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Wspólne opcje dla wszystkich wykresów
    const commonOptions = {
        colors: ['#dc3545'],
        stroke: {
            curve: 'smooth'
        },
        dataLabels: {
            enabled: false
        },
        markers: {
            size: 4,
            colors: ['#dc3545'],
            strokeColors: '#fff',
            strokeWidth: 2
        },
    };

    // Konfiguracja wykresu miesięcznego
    const monthlyData = @json($monthlyData);
    const monthlyOptions = {
        ...commonOptions,
        series: [{
            name: 'Odwiedziny',
            data: monthlyData.map(item => item.visits)
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        xaxis: {
            categories: monthlyData.map(item => item.month)
        },
        title: {
            text: 'Odwiedziny miesięczne'
        },
        plotOptions: {
            bar: {
                borderRadius: 4
            }
        }
    };
    new ApexCharts(document.querySelector("#monthlyChart"), monthlyOptions).render();

    // Konfiguracja wykresu dziennego
    const dailyData = @json($dailyData);
    const dailyOptions = {
        ...commonOptions,
        series: [{
            name: 'Odwiedziny',
            data: dailyData.map(item => item.visits)
        }],
        chart: {
            type: 'line',
            height: 350
        },
        xaxis: {
            categories: dailyData.map(item => item.day)
        },
        title: {
            text: 'Odwiedziny dzienne'
        }
    };
    new ApexCharts(document.querySelector("#dailyChart"), dailyOptions).render();

    // Konfiguracja wykresu godzinowego
    const hourlyData = @json($hourlyData);
    const hourlyOptions = {
        ...commonOptions,
        series: [{
            name: 'Odwiedziny',
            data: hourlyData.map(item => item.visits)
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        xaxis: {
            categories: hourlyData.map(item => item.hour)
        },
        title: {
            text: 'Odwiedziny godzinowe'
        },
        plotOptions: {
            bar: {
                borderRadius: 4
            }
        }
    };
    new ApexCharts(document.querySelector("#hourlyChart"), hourlyOptions).render();

    // Obsługa zmiany roku i kategorii
    function updateStats() {
        const year = document.getElementById('yearSelect').value;
        const categoryId = document.getElementById('categorySelect').value;
        const url = new URL(window.location.href);
        url.searchParams.set('year', year);
        if (categoryId) {
            url.searchParams.set('category_id', categoryId);
        } else {
            url.searchParams.delete('category_id');
        }
        window.location.href = url.toString();
    }

    document.getElementById('yearSelect').addEventListener('change', updateStats);
    document.getElementById('categorySelect').addEventListener('change', updateStats);
});
</script>
@endpush
@endsection