@section('title', 'Workshop - ' . $workshop->name)

@extends('layouts.workshop-app')

@section('content')
    <div class="workshop-header">
        <axios-background-image 
        class="header-image" 
        image="{{ $workshop->image_header }}"
        url-ajax="{{ route('update-workshop-image', compact('workshop')) }}"></axios-background-image>


        <div class="data">
            <workshop-input
            url-ajax="{{ route('update-workshop', compact('workshop')) }}"
            :workshop="{{$workshop}}"
            >
            </workshop-input>
        </div>

        <div class="setting-page" v-on:click="toggleSettings">
            <img src="/icons/settings.svg" alt="">
        </div>
    </div>  

    <router-view></router-view>

@endsection

@section('invisible-content')

    {{-- url setting !!! dont touch, only for vuejs router --}}
   <p id="workshop-id">{{$workshop->id}}</p>

@endsection

