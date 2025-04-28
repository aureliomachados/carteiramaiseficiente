@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Stocks</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('stocks.create') }}"> Create New Stock</a>
            </div>
            <hr>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered" id="stocks-table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Logo URL</th>
                <th>ID Investidor10</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
            <tr>
                <td style="display: flex; align-items: center;">
                    <img src="{{ $stock->logo_url }}" alt="Logo" style="width: 50px; height: auto; margin-right: 10px;">{{ $stock->codigo }}
                </td>
                <td>{{ $stock->nome }}</td>
                <td>{{ $stock->logo_url }}</td>
                <td>{{ $stock->id_investidor10 }}</td>
                <td>
                    <form action="{{ route('stocks.destroy',$stock->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('stocks.show',$stock->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('stocks.edit',$stock->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#stocks-table').DataTable();
});
</script>
@endsection