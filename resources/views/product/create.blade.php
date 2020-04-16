@extends('layouts.app')
@section('content')
    <h1 class="col-md-12 text-center mt-3">Create product</h1>
    {!! Form::open(['action' => 'ProductController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', '', ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Description:') }}
            {{ Form::textarea('description', '', ['class' => 'form-control']) }}
        </div>
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection