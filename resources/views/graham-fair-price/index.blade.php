@extends('layouts.app')

@section('styles')
<style>
    .lds-dual-ring {
        display: inline-block;
        width: 60px;
        height: 60px;
    }
    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 48px;
        height: 48px;
        margin: 6px;
        border-radius: 50%;
        border: 6px solid #000;
        border-color: #000 transparent #000 transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }
    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    .arrow-up {
        color: green;
        margin-right: 5px;
    }
    .arrow-down {
        color: red;
        margin-right: 5px;
    }
    .bold-text {
        font-weight: bold;
    }
    @media (max-width: 768px) {
        .container {
            padding: 0 15px;
        }
        h1, h2 {
            font-size: 1.5em;
        }
        #price-progress-chart {
            width: 100% !important;
            height: auto !important;
        }
        #stocks-table, #quarantine-table {
            width: 100% !important;
            overflow-x: auto;
            display: block;
        }
    }
</style>
@endsection

@section('title', 'Preço Justo Graham')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Preço Justo Graham</h1>

                <!-- Descrição resumida do método Graham -->
                <p>O método Graham é utilizado para calcular o preço justo de uma ação com base no valor patrimonial por ação (VPA) e no lucro por ação (LPA). Este método ajuda os investidores a determinar o preço máximo que devem pagar por uma ação para garantir um investimento seguro e rentável.</p>

                <div id="progress-circle-container" class="mt-4 text-center">
                    <div class="lds-dual-ring"></div>
                </div>

                <div id="dividend-data" class="mt-4" style="display: none;">
                    <h2 class="text-center">Ações</h2>
                </div>

                <div id="quarantine-data" class="mt-4" style="display: none;">
                    <h2 class="text-center">Ações em quarentena</h2>
                </div>

                <div class="mt-4">
                    <h2>Gráfico de progresso do preço justo</h2>
                    <canvas id="price-progress-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>

    $(document).ready(function() {
    const stockPricesUrl = 'stock-prices/{{auth()->user()->id}}'; // Substitua pela URL correta do serviço stock-prices
    const historicalIndicatorsUrl = 'historical-indicators/{{auth()->user()->id}}'; // URL do serviço de indicadores históricos

    const dividendData = $('#dividend-data');
    const quarantineData = $('#quarantine-data');
    const progressCircleContainer = $('#progress-circle-container');
    const priceProgressChartCtx = document.getElementById('price-progress-chart').getContext('2d');
    let priceProgressChart;

    // Initialize DataTables
    const table = $('<table id="stocks-table" class="display"><thead><tr><th>Ação</th><th>Preço Atual</th><th>Preço Justo Graham</th><th>Potencial de Valorização</th></tr></thead><tbody></tbody></table>');
    const quarantineTable = $('<table id="quarantine-table" class="display"><thead><tr><th>Ação</th><th>Preço Atual</th><th>Preço Justo Graham</th><th>Potencial de Valorização</th></tr></thead><tbody></tbody></table>');
    dividendData.append(table);
    quarantineData.append(quarantineTable);
    const dataTable = $('#stocks-table').DataTable({
        responsive: true
    });
    const quarantineDataTable = $('#quarantine-table').DataTable({
        responsive: true
    });

    // Function to calculate Graham's fair price
    function calculateGrahamPrice(vpa, lpa) {
        return Math.sqrt(22.5 * vpa * lpa);
    }

    // Function to calculate potential appreciation
    function calculatePotentialAppreciation(currentPrice, grahamPrice) {
        return ((grahamPrice - currentPrice) / currentPrice) * 100;
    }

    // Function to fetch stock prices
    function fetchStockPrices() {
        return $.get(stockPricesUrl);
    }

    // Function to fetch historical indicators
    function fetchHistoricalIndicators() {
        return $.get(historicalIndicatorsUrl);
    }

    // Function to process stock data
    function processStockData(stockData, historicalIndicatorsData) {
        const totalStocks = stockData.length;
        let processedStocks = 0;
        const chartLabels = [];
        const currentPrices = [];
        const grahamPrices = [];
        const priceDifferences = [];
        const historicalData = [];

        stockData.forEach(stock => {
            const stockSymbol = stock.stock.toUpperCase();
            const indicators = historicalIndicatorsData[stockSymbol] || {};

            // Calculate Graham's fair price
            const grahamPrice = calculateGrahamPrice(indicators.VPA, indicators.LPA);

            // Calculate potential appreciation
            const potentialAppreciation = calculatePotentialAppreciation(stock.regularMarketPrice, grahamPrice);

            // Calculate price difference
            const priceDifference = grahamPrice - stock.regularMarketPrice;

            // Update or add row in appropriate DataTable
            updateDataTable(stock, stockSymbol, grahamPrice, potentialAppreciation);

            // Update chart data
            chartLabels.push(stockSymbol);
            currentPrices.push(stock.regularMarketPrice);
            grahamPrices.push(grahamPrice);
            priceDifferences.push(priceDifference);

            console.log(stock);

            // Add to historical data JSON object list
            historicalData.push({
                user_id: {{auth()->user()->id}}, // Assuming user_id is part of stock data
                stock_id: stock.stock, // Assuming stock_id is part of stock data
                date: new Date().toISOString().split('T')[0], // Current date in YYYY-MM-DD format
                preco_justo: grahamPrice,
                preco_atual: stock.regularMarketPrice,
                potencial_valorizacao: potentialAppreciation
            });

            // Update progress
            processedStocks++;
            if (processedStocks === totalStocks) {
                renderChart(chartLabels, currentPrices, priceDifferences);
                sendHistoricalData(historicalData); // Send data after processing
            }
        });
    }

    // Function to send historical data to the server
    function sendHistoricalData(historicalData) {
        $.ajax({
            url: '{{ route("saveHistoricalData") }}', // Ensure this route is correctly defined in your routes file
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(historicalData),
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            },
            success: function(response) {
                console.log('Data saved successfully:', response);
            },
            error: function(xhr, status, error) {
                console.error('Error saving data:', error);
            }
        });
    }

    // Function to update DataTable
    function updateDataTable(stock, stockSymbol, grahamPrice, potentialAppreciation) {
        const stockNameWithLogo = `<img src="${stock.logoUrl}" alt="${stock.stock}" style="width: 20px; height: 20px; margin-right: 10px;">${stockSymbol}`;
        const potentialAppreciationArrow = potentialAppreciation > 0 ? '<span class="arrow-up">&#9650;</span>' : '<span class="arrow-down">&#9660;</span>';
        const rowData = [
            stockNameWithLogo,
            stock.regularMarketPrice.toFixed(2),
            grahamPrice.toFixed(2),
            potentialAppreciationArrow + potentialAppreciation.toFixed(2) + '%'
        ];

        if (stock.regularMarketPrice > grahamPrice) {
            // Add to quarantine table
            const existingQuarantineRow = quarantineDataTable.row((idx, data, node) => data[0].includes(stockSymbol));
            if (existingQuarantineRow.length) {
                existingQuarantineRow.data(rowData).draw();
            } else {
                quarantineDataTable.row.add(rowData).draw();
            }
        } else {
            // Add to main table
            const existingRow = dataTable.row((idx, data, node) => data[0].includes(stockSymbol));
            if (existingRow.length) {
                existingRow.data(rowData).draw();
            } else {
                dataTable.row.add(rowData).draw();
            }
        }
    }

    // Function to render chart
    function renderChart(labels, currentPrices, priceDifferences) {
        progressCircleContainer.hide();
        dividendData.show();
        quarantineData.show();

        if (priceProgressChart) {
            priceProgressChart.destroy();
        }
        priceProgressChart = new Chart(priceProgressChartCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Preço Atual',
                    data: currentPrices,
                    backgroundColor: 'rgba(78, 137, 98, 1)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, {
                    label: 'Diferença para Preço Justo',
                    data: priceDifferences,
                    backgroundColor: 'rgba(128, 128, 128, 0.2)', // Change to gray
                    borderColor: 'rgba(128, 128, 128, 1)', // Change to gray
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        display: true,
                        align: 'end',
                        anchor: 'end',
                        formatter: function(value, context) {
                            const datasetIndex = context.datasetIndex;
                            if (datasetIndex === 1) {
                                return value.toFixed(2);
                            }
                            return '';
                        }
                    }
                },
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Function to fetch and render data
    function fetchDataAndRender() {
        progressCircleContainer.show();
        dividendData.hide();
        quarantineData.hide();

        $.when(fetchStockPrices(), fetchHistoricalIndicators())
            .done((stockData, historicalIndicatorsData) => {
                processStockData(stockData[0], historicalIndicatorsData[0]);
            })
            .fail(error => {
                console.error('Erro ao consumir as APIs:', error);
            });
    }

    // Initial render
    fetchDataAndRender();
});
</script>
@endsection