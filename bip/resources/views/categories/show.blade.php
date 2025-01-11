@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $category->name }}</h3>
        </div>
        <div class="card-body">
            {!! $category->content !!}
            
            @if(auth()->check())
                <div class="mt-3">
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edytuj</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <div class="card mt-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">Metryka dokumentu</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered">
            <tbody>
                <tr>
                    <th class="bg-light" style="width: 200px">Data utworzenia:</th>
                    <td>{{ $category->created_at ? $category->created_at->format('d.m.Y H:i') : 'Brak danych' }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Utworzył:</th>
                    <td>{{ $category->creator->name ?? 'Brak danych' }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Data ostatniej modyfikacji:</th>
                    <td>{{ $category->updated_at ? $category->updated_at->format('d.m.Y H:i') : 'Brak danych' }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Ostatnio modyfikował:</th>
                    <td>{{ $category->updater->name ?? 'Brak danych' }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Liczba zmian:</th>
                    <td>{{ $category->changes_count }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Liczba odwiedzin:</th>
                    <td>{{ $category->visits_count }}</td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#historyModal">
            Rejestr zmian
        </button>
        <div class="card mt-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Statystyki odwiedzin</h5>
            </div>
            <div class="card-body">
                <div id="visitsChart" style="height: 300px;"></div>
            </div>
        </div>

        @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($visitChartData);
            
            const options = {
                series: [{
                    name: 'Odwiedziny',
                    data: chartData.map(item => ({
                        x: new Date(item.date).getTime(),
                        y: item.count
                    }))
                }],
                chart: {
                    type: 'area',
                    height: 300,
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'datetime'
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return Math.round(val);
                        }
                    }
                },
                tooltip: {
                    x: {
                        format: 'dd MMM yyyy'
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#visitsChart"), options);
            chart.render();
        });
        </script>
        @endpush
    </div>
</div>

<!-- Modal z historią zmian -->
<div class="modal fade" id="historyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Historia zmian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Autor zmian</th>
                                <th>Nowa nazwa</th>
                                <th>Nowa treść</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->history()->orderBy('created_at', 'desc')->get() as $history)
                                <tr>
                                    <td>{{ $history->created_at->format('d.m.Y H:i') }}</td>
                                    <td>{{ $history->user->name }}</td>
                                    <td>{{ $history->new_name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#contentModal{{ $history->id }}">
                                            Pokaż treść
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>{{ $category->created_at->format('d.m.Y H:i') }}<br><span class="badge bg-success">Utworzenie</span></td>
                                <td>{{ $category->creator->name }}</td>
                                <td>{{ $originalName }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#contentModalInitial">
                                        Pokaż treść
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($category->history()->orderBy('created_at', 'desc')->get() as $history)
    <div class="modal fade" id="contentModal{{ $history->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Treść z dnia {{ $history->created_at->format('d.m.Y H:i') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {!! $history->new_content !!}
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- Modal dla pierwotnej wersji -->
<div class="modal fade" id="contentModalInitial" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Treść oryginalna z dnia {{ $category->created_at->format('d.m.Y H:i') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                {!! $originalContent !!}
            </div>
        </div>
    </div>
</div>
@endsection