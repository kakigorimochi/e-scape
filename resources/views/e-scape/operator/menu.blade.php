@extends('layouts.app')

@section('css')
@isset($css)
@foreach($css as $c)
<link href="{{ asset('css/'.$c.'.css') }}" rel="stylesheet" type="text/css" />
@endforeach
@endisset
@endsection

@section('content')
<operator-index :info="{{ json_encode($info) }}"
    :is-unlocked="{{ json_encode($is_unlocked) }}"></operator-index>
@endsection
