@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1>Bem-vindo à Carteira +Eficiente</h1>
            <p class="lead">Esta aplicação traz métodos de escolha de ações com base no método Basin e no método de Preço Justo de Benjamin Graham.</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Método Basin
                </div>
                <div class="card-body">
                    <p class="card-text">
                        O método Basin é uma abordagem quantitativa que utiliza uma combinação de análise técnica e fundamental para identificar ações subvalorizadas. Ele se concentra em encontrar empresas com fortes fundamentos financeiros e um histórico de desempenho consistente, enquanto também considera fatores técnicos como padrões de preço e volume de negociação.
                    </p>
                    <!-- Adicione mais detalhes sobre o método Basin aqui, se necessário -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Método de Preço Justo de Benjamin Graham
                </div>
                <div class="card-body">
                    <p class="card-text">
                        O método de Preço Justo de Benjamin Graham, também conhecido como "Value Investing", é uma estratégia de investimento que busca identificar ações que estão sendo negociadas por menos do que seu valor intrínseco. Graham desenvolveu fórmulas e critérios específicos para avaliar o valor de uma empresa, focando em fatores como lucros, dividendos, ativos e passivos. O objetivo é encontrar ações que ofereçam uma margem de segurança significativa, minimizando o risco de perda.
                    </p>
                    <!-- Adicione mais detalhes sobre o método de Preço Justo aqui, se necessário -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection