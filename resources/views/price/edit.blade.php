@extends('layouts.app')
@section('content')
    <h1 class="col-md-12 text-center mt-3">Edit price</h1>
    {!! Form::open(['action' => ['PriceController@update', $price->id, $productId], 'method' => 'PUT']) !!}
        <div class="form-group">
            {{ Form::label('amount', 'Amount:') }}
            {{ Form::number('amount', $price->amount, ['class' => 'form-control', 'step' => '0.01']) }}
        </div>
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection