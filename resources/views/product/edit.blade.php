@extends('layouts.app')
@section('content')
    <h1 class="col-md-12 text-center mt-3">Edit product</h1>
    {!! Form::open(['action' => ['ProductController@update', $product->id], 'method' => 'PUT']) !!}
        <div class="form-group">
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', $product->name, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Description:') }}
            {{ Form::textarea('description', $product->description, ['class' => 'form-control']) }}
        </div>
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection