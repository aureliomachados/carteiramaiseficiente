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
        border: 4px solid #000;
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
    /* Ajuste para tabelas responsivas */
    .table-responsive {
        overflow-x: auto;
    }
</style>
@endsection

@section('title', 'Preço Teto Basin')

@section('content')
    <!-- Adicionando a meta tag viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Preço teto basin</h1>

                <!-- Descrição resumida do método basin -->
                <p>O método basin é utilizado para calcular o preço teto de uma ação com base na taxa de retorno desejada e no rendimento médio dos dividendos. Este método ajuda os investidores a determinar o preço máximo que devem pagar por uma ação para atingir a taxa de retorno esperada.</p>

                <form id="return-rate-form">
                    <div class="form-group">
                        <label for="return-rate">Taxa de Retorno Desejada (%)</label>
                        <input type="number" class="form-control" id="return-rate" name="return-rate" step="0.01" value="6" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Calcular</button>
                </form>

                <div id="progress-circle-container" class="mt-4 text-center">
                    <div class="lds-dual-ring"></div>
                </div>

                <div id="dividend-data" class="mt-4 table-responsive" style="display: none;">
                    <h2 class="text-center">Ações</h2>
                </div>

                <div id="quarantine-data" class="mt-4 table-responsive" style="display: none;">
                    <h2 class="text-center">Ações em quarentena</h2>
                </div>

                <div class="mt-4">
                    <h2 class="text-center">Gráfico de progresso do preço teto</h2>
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
        const dividendYieldUrl = 'dividend-yield/{{auth()->user()->id}}'; // URL do serviço de dividendos
        const historicalIndicatorsUrl = 'historical-indicators/{{auth()->user()->id}}'; // URL do serviço de indicadores históricos

        const dividendData = $('#dividend-data');
        const quarantineData = $('#quarantine-data');
        const progressCircleContainer = $('#progress-circle-container');
        const priceProgressChartCtx = document.getElementById('price-progress-chart').getContext('2d');
        let priceProgressChart;

        // Initialize DataTables
        const table = $('<table id="stocks-table" class="display table table-striped"><thead><tr><th>Ação</th><th>Preço Atual</th><th>Preço Teto</th><th>Taxa desejada</th><th>Margem de Segurança</th></tr></thead><tbody></tbody></table>');
        const quarantineTable = $('<table id="quarantine-table" class="display table table-striped"><thead><tr><th>Ação</th><th>Preço Atual</th><th>Preço Teto</th><th>Taxa desejada</th><th>Margem de Segurança</th></tr></thead><tbody></tbody></table>');
        dividendData.append(table);
        quarantineData.append(quarantineTable);
        const dataTable = $('#stocks-table').DataTable();
        const quarantineDataTable = $('#quarantine-table').DataTable();

        // Function to calculate ceiling price
        function calculateCeilingPrice(averageDividendYield, desiredReturn) {
            if (desiredReturn === 0) {
                throw new Error("O retorno desejado não pode ser zero.");
            }
            return (averageDividendYield / desiredReturn) * 100;
        }

        // Function to calculate safety margin
        function calculateSafetyMargin(currentPrice, ceilingPrice) {
            return ((ceilingPrice - currentPrice) / currentPrice) * 100;
        }

        // Function to fetch stock prices
        function fetchStockPrices() {
            return $.get(stockPricesUrl);
        }

        // Function to fetch dividend yields
        function fetchDividendYields() {
            return $.get(dividendYieldUrl);
        }

        // Function to fetch historical indicators
        function fetchHistoricalIndicators() {
            return $.get(historicalIndicatorsUrl);
        }

        // Function to process stock data
        function processStockData(stockData, dividendReturnedData, historicalIndicatorsData, returnRate) {
            const totalStocks = stockData.length;
            let processedStocks = 0;
            const chartLabels = [];
            const currentPrices = [];
            const ceilingPrices = [];
            const safetyMargins = [];

            stockData.forEach(stock => {
                const stockSymbol = stock.stock.toUpperCase();
                const dividends = dividendReturnedData[stockSymbol] || [];
                const indicators = historicalIndicatorsData[stockSymbol] || {};

                // Get only the last 5 created_at
                const lastFiveDividends = dividends.slice(-5);

                // Calculate the average dividend yield
                const averageDividendYield = lastFiveDividends.reduce((total, item) => total + item.price, 0) / lastFiveDividends.length;

                // Calculate the ceiling price
                const ceilingPrice = calculateCeilingPrice(averageDividendYield, returnRate);

                // Calculate safety margin
                const safetyMargin = calculateSafetyMargin(stock.regularMarketPrice, ceilingPrice);

                // Update or add row in appropriate DataTable
                updateDataTable(stock, stockSymbol, ceilingPrice, safetyMargin, returnRate);

                // Update chart data
                chartLabels.push(stockSymbol);
                currentPrices.push(stock.regularMarketPrice);
                ceilingPrices.push(ceilingPrice - stock.regularMarketPrice);
                safetyMargins.push(safetyMargin);

                // Update progress
                processedStocks++;
                if (processedStocks === totalStocks) {
                    renderChart(chartLabels, currentPrices, ceilingPrices);
                }
            });
        }

        // Function to update DataTable
        function updateDataTable(stock, stockSymbol, ceilingPrice, safetyMargin, returnRate) {
            const stockNameWithLogo = `<img src="${stock.logoUrl}" alt="${stock.stock}" style="width: 20px; height: 20px; margin-right: 10px;">${stockSymbol}`;
            const safetyMarginArrow = safetyMargin > 0 ? '<span class="arrow-up">&#9650;</span>' : '<span class="arrow-down">&#9660;</span>';
            const ceilingPriceText = ceilingPrice > stock.regularMarketPrice ? `<span class="bold-text">${ceilingPrice.toFixed(2)}</span>` : ceilingPrice.toFixed(2);
            const rowData = [
                stockNameWithLogo,
                stock.regularMarketPrice.toFixed(2),
                ceilingPriceText,
                returnRate + '%',
                safetyMarginArrow + safetyMargin.toFixed(2) + '%'
            ];

            if (stock.regularMarketPrice > ceilingPrice) {
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
        function renderChart(labels, currentPrices, ceilingPrices) {
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
                        label: 'Para atingir Preço Teto',
                        data: ceilingPrices,
                        backgroundColor: 'rgba(133, 214, 161, 1)',
                        borderColor: 'rgba(133, 214, 161, 1)',
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
                                    return (value + currentPrices[context.dataIndex]).toFixed(2);
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
    function fetchDataAndRender(returnRate) {
        progressCircleContainer.show();
        dividendData.hide();
        quarantineData.hide();

        // Ensure that each fetch function returns a promise
        $.when(fetchStockPrices(), fetchDividendYields(), fetchHistoricalIndicators())
            .done((stockData, dividendReturnedData, historicalIndicatorsData) => {
                processStockData(stockData[0], dividendReturnedData[0], historicalIndicatorsData[0], returnRate);
            })
            .fail(error => {
                console.error('Erro ao consumir as APIs:', error);
                progressCircleContainer.hide(); // Hide the loader in case of error
            });
    }

    // Initial render with default return rate
    fetchDataAndRender(6);

    // Handle form submission
    $('#return-rate-form').on('submit', function(event) {
        event.preventDefault();
        const returnRate = parseFloat($('#return-rate').val());
        fetchDataAndRender(returnRate);
    });
    });
</script>
@endsection