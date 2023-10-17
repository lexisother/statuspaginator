@extends('layouts.app')

@foreach($sites as $site)
    {{ $site->url }}
@endforeach
