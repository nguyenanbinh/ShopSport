@extends('admin.main')
@section('content')
<table class="table table-bordered" style="width: 50%;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Description</th>
            <th>Discount </th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
 
    <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->quantity}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->description}}</td>
        @if(isset($sale))
        <td>{{$sale->discount}}%</td>
        @else
        <td>###</td>
         @endif
        <td>###</td>



@endsection