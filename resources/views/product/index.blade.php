@extends('layouts.app')
@section('content')

    <h1 class="col-md-12 text-center mt-3">Products list</h1>
    @auth
    <div class="col-md-12">
        <a href="/products/create" class="btn btn-success mb-2 mt-2 float-right">New product</a>
    </div>
    @endauth
    @if(count($products) > 0)
        <div class="col-md-12">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

            @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <a href="/products/{{ $product->id }}" class="btn btn-primary">Details</a>
                        </td>
                    </tr>
            @endforeach

                </tbody>
            </table>
        </div>
        {{ $products->links() }}
    @endif

@endsection