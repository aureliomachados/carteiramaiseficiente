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

    <!-- Responsive table wrapper -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Stock</th>
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
                @endphp
                @foreach ($groupedData as $key => $data)
                    @php
                        list($stockId, $year, $month) = explode('-', $key);
                        $stockName = $data->first()->stock->codigo;
                        $stockLogo = $data->first()->stock->logo_url;
                        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                    @endphp
                    <tr>
                        <td><strong>{{ $stockName }}</strong> <img src="{{ $stockLogo }}" alt="{{ $stockName }}" style="width: 50px; height: auto;"></td>
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
@endsection