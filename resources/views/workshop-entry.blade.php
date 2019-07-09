@section('title', 'Workshop - ' . $workshop->name)

@extends('layouts.workshop-app')

@section('content')
    <div class="workshop-header mb-3">
        <axios-background-image class="header-image"></axios-background-image>

        <div class="data">
            <workshop-input
            url-ajax="{{ route('update-workshop', compact('workshop')) }}"
            :workshop="{{$workshop}}"
            >
            </workshop-input>
        </div>

        <div class="setting-page" v-on:click="toggleSettings" v-if="isAuthor">
            <img src="/icons/settings.svg" alt="">
        </div>
    </div>  

    <transition  name="fade" mode="out-in">
        <router-view></router-view>
    </transition>

@endsection

@section('invisible-content')

    {{-- url setting !!! dont touch, only for vuejs router --}}
   <p id="workshop-id">{{ $workshop->id }}</p>
   <p id="site-base-url">{{ URL::to('/') }}</p>
   <p id="workshop-base-url">{{ route('workshop-entry', compact('workshop')) }}</p>

@endsection

