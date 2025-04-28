<!-- resources/views/calculadoraPrecoTeto/index.blade.php -->
@extends('layouts.app')

@section('title', 'Calculadora Preço Teto')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card" style="width: 100%; max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title text-center">Calculadora Preço Teto</h5>
                <form action="{{ route('calculadoraPrecoTeto.calculate') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="dividendYield">Dividend Yield médio dos últimos 5 anos (%)</label>
                        <input type="number" step="0.01" class="form-control" id="dividendYield" name="dividendYield" required value="{{ old('dividendYield', $dividendYield ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="desiredReturn">Porcentagem desejada de rentabilidade</label>
                        <select class="form-control" id="desiredReturn" name="desiredReturn" required>
                            <option value="6" {{ (old('desiredReturn', $desiredReturn ?? '') == 6) ? 'selected' : '' }}>6%</option>
                            <option value="8" {{ (old('desiredReturn', $desiredReturn ?? '') == 8) ? 'selected' : '' }}>8%</option>
                            <option value="10" {{ (old('desiredReturn', $desiredReturn ?? '') == 10) ? 'selected' : '' }}>10%</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Calcular</button>
                </form>

                @if(isset($precoTeto))
                    <div class="alert alert-success mt-3" role="alert">
                        <h4 class="alert-heading">Resultado:</h4>
                        <p>O preço teto calculado é: <strong>{{ number_format($precoTeto, 2) }}</strong></p>
                    </div>
                @endif

                @if(isset($precoTeto6) && isset($precoTeto8) && isset($precoTeto10))
                    <canvas id="precoTetoChart" width="400" height="200"></canvas>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(isset($precoTeto6) && isset($precoTeto8) && isset($precoTeto10))
                var ctx = document.getElementById('precoTetoChart').getContext('2d');
                var precoTetoChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['6%', '8%', '10%'],
                        datasets: [{
                            label: 'Preço Teto',
                            data: [{{ $precoTeto6 }}, {{ $precoTeto8 }}, {{ $precoTeto10 }}],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            @endif
        });
    </script>
@endsection