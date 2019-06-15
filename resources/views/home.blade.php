@section('title', 'Home')

@extends('layouts.app')

@section('content')

    <div class="container p-3" id="app">

        <div class="row">
            <div class="col-3 border-right">
                <h3>Workhops</h3>
                @foreach ($workshops as $workshop)
                    <p>{{ $workshop->name }}</p>
                @endforeach 
            </div>
        </div>
        
    </div>
    
@endsection
