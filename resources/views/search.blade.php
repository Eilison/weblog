@extends('layouts.app')

@section('content')
    @component('particals.jumbotron')
        <h4>搜索:{{ request()->get('q') }}</h4>
        <h6>这是您需要的结果吗？</h6>
    @endcomponent

    @include('widgets.article')

@endsection