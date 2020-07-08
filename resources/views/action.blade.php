@extends('layouts.app')

@section('styles')
    <link href="css/action.css" rel="stylesheet" />
@endsection


@section('content')
    <!-- show all Actopns -->
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Client Name</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Notes</th>
                </tr>
            </thead>

            <tbody>
                @foreach($actions as $action)

                    <tr class="@if($action->type == 'import') import-record @else export-record @endif">
                        <td class="date-field">{{ $action->date }} </td>

                        <td class="type-field">
                            @if($action->type == 'import') <i class="fas fa-long-arrow-alt-up fa-lg"></i>
                            @else <i class="fas fa-long-arrow-alt-down fa-lg"></i> @endif
                            {{ $action->type }}
                        </td>
                        <td>{{ $action->client_name }}</td>
                        <td>{{ $action->product_name }}</td>
                        <td>{{ $action->price }}</td>
                        <td>{{ $action->quantity }}</td>
                        <td>{{ $action->notes }} @if($action->notes == null) -  @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
