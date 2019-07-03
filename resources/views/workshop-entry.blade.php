@section('title', 'Workshop - ' . $workshop->name)

@extends('layouts.workshop-app')

@section('content')

        <router-view></router-view>
    {{-- <workshop-entry 
                :workshop="{{ $workshop->toJson() }}"
                :decks="{{ $decks->toJson() }}"
                url-ajax="{{ route('workshop-entry', compact('workshop')) }}" 
                @if(Auth::check())
                    :author="{{ Auth::user()->toJson() }}"
                @endif
                >                
    </workshop-entry> --}}

@endsection

@section('invisible-content')

   <p id="workshop-id">{{$workshop->id}}</p>

@endsection

