@section('title', 'Workshop - ' . $workshop->name)

@extends('layouts.app')

@section('content')
  <div class="workshop-join">
    <img src="{{ $workshop->image }}" alt="">
    <h1>{{ $workshop->name }}</h1>
    <h2>{{ $workshop->description }}</h2>
    <p>Hosted by {{ $workshop->author->name }}</p>
    <p>from {{ \Carbon\Carbon::parse($workshop->start_date)->format('d/m/Y') }} to {{ \Carbon\Carbon::parse($workshop->end_date)->format('d/m/Y') }}</p>
    <p>You was invited to participate.</p>

    @auth
       <a href="{{ route('workshop-join', compact('joinCode')) }}"><button>Join The workshop</button></a>
    @endauth

    @guest
        {{-- The user is not authenticated... --}}
        <p>You should be logged in to join a workshop.</p>
        <div>
          <a href="{{ route('login') }}"><button>Connection</button></a>
          <a href="{{ route('register') }}"><button>Sign In</button></a>
        </div>
    @endguest  
  </div>  
@endsection

