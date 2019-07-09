@section('title', 'Workshop - ' . $workshop->name)

@extends('layouts.workshop-app')

@section('content')
  <div class="workshop-join">
    <img src="{{ $workshop->image }}" alt="">
    <h1>{{ $workshop->name }}</h1>
    <h2>{{ $workshop->description }}</h2>
    <p>Hosted by {{ $workshop->author->name }}</p>
    <p>from {{ $workshop->start_date->isoFormat('dd/mm/yyyy') }} to {{ $workshop->end_date->isoFormat('dd/mm/yyyy') }}</p>
    <p>You was</p>
  </div>  
@endsection

