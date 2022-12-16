@extends('layouts.app')

@section('content')
   <game :link="{{$link}}" :user="{{$user}}" />
@endsection
