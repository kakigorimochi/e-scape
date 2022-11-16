@extends('layouts.app')

@section('css')
@isset($css)
@foreach($css as $c)
<link href="{{ asset('css/'.$c.'.css') }}" rel="stylesheet" type="text/css" />
@endforeach
@endisset
@endsection

@section('content')
<commuter-login message="{{ \Illuminate\Support\Facades\Session::get('message', "") }}"
    :user-type="{{ json_encode($user_type) }}"></commuter-login>
@endsection
