@extends('layouts.app')

@section('title', 'Historical Data')

@section('content')
<div class="container">
    <h1>Dados históricos Graham</h1>

    <!-- Legend for the bars -->
    <div class="mb-3">
        <div style="display: inline-block; width: 20px; height: 10px; background-color: blue; margin-right: 5px;"></div> Preço Atual
        <div style="display: inline-block; width: 20px; height: 10px; background-color: green; margin-left: 20px; margin-right: 5px;"></div> Preço Justo
    </div>

    <!-- Responsive table wrapper with an ID for JavaScript -->
    <div class="table-responsive" id="scrollable-table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="position: sticky; left: 0; background-color: white; z-index: 1;">Stock</th>
                    <th>Month</th>
                    @for ($day = 1; $day <= 31; $day++)
                        <th>{{ $day }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @php
                    // Get current year and month
                    $currentYear = now()->year;
                    $currentMonth = now()->month;

                    // Filter data for the current month and year
                    $filteredData = $historicalData->filter(function ($item) use ($currentYear, $currentMonth) {
                        $dateParts = explode('-', $item->date);
                        return $dateParts[0] == $currentYear && $dateParts[1] == sprintf('%02d', $currentMonth);
                    });

                    // Group filtered data by stock
                    $groupedData = $filteredData->groupBy(function ($item) {
                        $dateParts = explode('-', $item->date);
                        return $item->stock_id . '-' . $dateParts[0] . '-' . $dateParts[1];
                    });

                    // Prepare data for the chart
                    $chartData = [];
                    foreach ($groupedData as $key => $data) {
                        $chartData[$key] = [
                            'labels' => [],
                            'preco_atual' => [],
                            'preco_justo' => [],
                            'stock_name' => $data->first()->stock->codigo
                        ];
                        foreach ($data as $item) {
                            $dateParts = explode('-', $item->date);
                            $day = (int)$dateParts[2];
                            $chartData[$key]['labels'][] = $day;
                            $chartData[$key]['preco_atual'][] = $item->preco_atual;
                            $chartData[$key]['preco_justo'][] = $item->preco_justo;
                        }
                    }
                @endphp
                @foreach ($groupedData as $key => $data)
                    @php
                        list($stockId, $year, $month) = explode('-', $key);
                        $stockName = $data->first()->stock->codigo;
                        $stockLogo = $data->first()->stock->logo_url;
                        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                    @endphp
                    <tr>
                        <td style="position: sticky; left: 0; background-color: white; z-index: 1;">
                            <button class="stock-button" data-stock="{{ $key }}" data-bs-toggle="modal" data-bs-target="#chartModal">
                                <img src="{{ $stockLogo }}" alt="{{ $stockName }}" style="width: 50px; height: auto;">
                            </button>
                        </td>
                        <td>{{ sprintf('%02d', $month) }}/{{ $year }}</td>
                        @for ($day = 1; $day <= 31; $day++)
                            <td>
                                @if ($day <= $daysInMonth)
                                    @php
                                        $date = sprintf('%s-%s-%02d', $year, $month, $day);
                                        $record = $data->firstWhere('date', $date);
                                    @endphp
                                    @if ($record)
                                        <div style="color: blue;" title="Preço Atual">{{ $record->preco_atual }}</div>
                                        <div style="color: green;" title="Preço Justo">{{ $record->preco_justo }}</div>
                                        <div style="width: 100%; height: 10px; background-color: lightgray;">
                                            <div style="width: {{ $record->preco_atual }}%; height: 100%; background-color: blue;"></div>
                                        </div>
                                        <div style="width: 100%; height: 10px; background-color: lightgray; margin-top: 2px;">
                                            <div style="width: {{ $record->preco_justo }}%; height: 100%; background-color: green;"></div>
                                        </div>
                                    @endif
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for displaying the chart -->
<div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chartModalLabel">Gráfico de Preços - <span id="stockName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap and Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for the line chart -->
<script>
    const chartData = @json($chartData);
    const ctx = document.getElementById('lineChart').getContext('2d');
    let lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'Preço Atual',
                    data: [],
                    borderColor: 'blue',
                    fill: false
                },
                {
                    label: 'Preço Justo',
                    data: [],
                    borderColor: 'green',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Dia do Mês'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Preço'
                    }
                }
            }
        }
    });

    document.querySelectorAll('.stock-button').forEach(button => {
        button.addEventListener('click', function() {
            const stockKey = this.getAttribute('data-stock');
            const data = chartData[stockKey];
            document.getElementById('stockName').textContent = data.stock_name;
            lineChart.data.labels = data.labels;
            lineChart.data.datasets[0].data = data.preco_atual;
            lineChart.data.datasets[1].data = data.preco_justo;
            lineChart.update();
        });
    });
</script>

<!-- JavaScript for drag to scroll -->
<script>
    const tableWrapper = document.getElementById('scrollable-table');
    let isDown = false;
    let startX;
    let scrollLeft;

    tableWrapper.addEventListener('mousedown', (e) => {
        isDown = true;
        tableWrapper.classList.add('active');
        startX = e.pageX - tableWrapper.offsetLeft;
        scrollLeft = tableWrapper.scrollLeft;
    });

    tableWrapper.addEventListener('mouseleave', () => {
        isDown = false;
        tableWrapper.classList.remove('active');
    });

    tableWrapper.addEventListener('mouseup', () => {
        isDown = false;
        tableWrapper.classList.remove('active');
    });

    tableWrapper.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - tableWrapper.offsetLeft;
        const walk = (x - startX) * 3; //scroll-fast
        tableWrapper.scrollLeft = scrollLeft - walk;
    });
</script>
@endsection