@extends('layouts.app')
@section('content')

    <div class="card mt-3" style="width: 100%;">
        <div class="card-header">
            {{ $product->name }}
        </div>
        <div class="card-body">
            <p class="card-text">{{ $product->description }}</p>
            @auth
            <a href="/products/{{$product->id}}/edit" class="btn btn-secondary mb-2">Edit product</a>
            {!! Form::open(['action' => ['ProductController@destroy', $product->id], 'method' => 'POST']) !!}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete product', ['class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
            @endauth
            <hr>

            @auth
            {!! Form::open(['action' => ['PriceController@store', $product->id], 'method' => 'POST']) !!}
                <div class="form-group">
                    {{ Form::label('amount', 'Amount:') }}
                    {{ Form::number('amount', '', ['class' => 'form-control', 'step' => '0.01']) }}
                </div>
                    {{ Form::submit('Add amount', ['class' => 'btn btn-primary']) }}
            {!! Form::close() !!}
            @endauth

            @if(count($prices) > 0)
                <table class="table mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Price</th>
                        @auth
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prices as $price)
                        <tr>
                            <th scope="row">#</th>
                            <td>{{ number_format($price->amount, 2) }} $</td>
                        @auth
                            <td><a href="/prices/{{$price->id}}/{{$product->id}}/edit" class="btn btn-secondary">Edit</a></td>
                            <td>
                            {!! Form::open(['action' => ['PriceController@destroy',$price->id, $product->id], 'method' => 'POST']) !!}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Delete price', ['class' => 'btn btn-danger']) }}
                            {!! Form::close() !!}
                            </td>
                        @endauth
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection