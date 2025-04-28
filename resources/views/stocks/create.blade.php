@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New Stock</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('stocks.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Código:</strong>
                    <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Código">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome:</strong>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Logo URL:</strong>
                    <input type="text" id="logo_url" name="logo_url" class="form-control" placeholder="Logo URL">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Investidor10:</strong>
                    <input type="text" name="id_investidor10" class="form-control" placeholder="ID Investidor10">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</div>

@endsection

@section('scripts')
<script>
   $(document).ready(function() {
    $('#codigo').on('blur', function() {
        var codigo = $(this).val();
        
        // Disable the fields before the AJAX request
        $('#nome, #logo_url, [name="id_investidor10"]').prop('disabled', true);

        if (codigo.length >= 5) {
            $.ajax({
                url: '/getstock-basicinfo/' + codigo,
                type: 'GET',
                success: function(data) {
                    if (data.error === "Stock já cadastrada") {
                        alert(data.error); // Display the specific error message
                    } else if (data) {
                        $('#codigo').val(codigo.toUpperCase());
                        $('#nome').val(data.nome);
                        $('#logo_url').val(data.logo_url);
                    } else {
                        console.log('No data found for the given Código.');
                    }
                },
                error: function() {
                    console.log('Error fetching data. Please try again.');
                },
                complete: function() {
                    // Enable the fields after the AJAX request completes
                    $('#nome, #logo_url, [name="id_investidor10"]').prop('disabled', false);
                }
            });
        } else {
            // Enable the fields if the condition is not met
            $('#nome, #logo_url, [name="id_investidor10"]').prop('disabled', false);
        }
    });
});
</script>
@endsection