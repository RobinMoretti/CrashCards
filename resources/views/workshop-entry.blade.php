@section('title', 'Workshop - ' . $workshop->name)

@extends('layouts.workshop-app')

@section('content')
    <div class="workshop-header">
        <div class="img-container" style="background: url('{{ asset('images/360.jpg') }}') no-repeat center center">
            {{-- <img src="{{ asset('images/360.jpg') }}" alt=""> --}}
        </div>

        <div class="data">
            <workshop-input
            url-ajax="{{ route('update-workshop', compact('workshop')) }}"
            :workshop="{{$workshop}}"
            >
            </workshop-input>
        </div>
    </div>  

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

    {{-- url setting !!! dont touch, only for vuejs app --}}
   <p id="workshop-id">{{$workshop->id}}</p>

@endsection

