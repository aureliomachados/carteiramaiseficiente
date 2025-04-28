<!-- resources/views/user/stocks/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Selecione suas ações</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ route('user.stocks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="stocks">Buscar Ações:</label>
            <input type="text" id="stock-search" class="form-control" placeholder="Digite o nome ou código da ação">
        </div>
        <ul id="selected-stocks" class="list-group mb-3"></ul>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

    <div class="mt-4">
        <table id="stocks-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userStocks as $userStock)
                    <tr id="stock-row-{{ $userStock->id }}">
                        <td>{{ $userStock->codigo }}</td>
                        <td>{{ $userStock->nome }}</td>
                        <td>
                            <button type="button" class="btn btn-danger remove-stock" data-id="{{ $userStock->id }}">Remover</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .ui-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        max-width: 100%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        z-index: 1000;
    }
    .ui-menu-item {
        padding: 10px;
        cursor: pointer;
    }
    .ui-menu-item:hover {
        background-color: #f0f0f0;
    }
    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
    // Initialize DataTable
    $('#stocks-table').DataTable();

    // Get already registered stocks
    var registeredStocks = @json($userStocks->pluck('id'));

    // Autocomplete for stock search
    $('#stock-search').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ url('stocks/autocomplete') }}/" + request.term,
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.codigo + ' - ' + item.nome,
                            value: item.id
                        };
                    }));
                }
            });
        },
        select: function(event, ui) {
            if (!registeredStocks.includes(ui.item.value)) {
                addStockToList(ui.item);
                $('#stock-search').val('');
            } else {
                alert('Esta ação já está cadastrada.');
            }
            return false;
        }
    }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
            .append("<div>" + item.label + "</div>")
            .appendTo(ul);
    };

    // Center the autocomplete list
    $('#stock-search').autocomplete("widget").addClass("dropdown-menu").css("width", "100%");

    function addStockToList(stock) {
        // Check if the stock is already in the list
        if ($('#selected-stock-' + stock.value).length === 0) {
            var listItem = $('<li class="list-group-item" id="selected-stock-' + stock.value + '">')
                .append(stock.label)
                .append('<button type="button" class="btn btn-danger btn-sm ml-2 remove-stock" data-id="' + stock.value + '">Remover</button>')
                .append('<input type="hidden" name="stocks[]" value="' + stock.value + '">');
            $('#selected-stocks').append(listItem);
        }
    }

    // Remove stock from the selected-stocks list without confirmation
    $(document).on('click', '#selected-stocks .remove-stock', function() {
        var stockId = $(this).data('id');
        $('#selected-stock-' + stockId).remove();
    });

    // Remove stock from the stocks-table with confirmation
    $(document).on('click', '#stocks-table .remove-stock', function() {
        var stockId = $(this).data('id');
        if (confirm('Deseja realmente excluir esta ação?')) {
            $.ajax({
                url: "{{ url('user/stocks') }}/" + stockId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    // Remove the row from the table
                    $('#stock-row-' + stockId).remove();
                    toastr.success(result.success);
                },
                error: function(xhr) {
                    toastr.error('Erro ao remover a ação.');
                }
            });
        }
    });
});
</script>
@endsection