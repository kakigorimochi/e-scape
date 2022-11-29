@extends('layouts.app')

@section('css')
@isset($css)
@foreach($css as $c)
<link href="{{ asset('css/'.$c.'.css') }}" rel="stylesheet" type="text/css" />
@endforeach
@endisset
@endsection

@section('content')
<operator-e-dispatch :dispatches="{{ json_encode($dispatches) }}"></operator-e-dispatch>
@endsection
