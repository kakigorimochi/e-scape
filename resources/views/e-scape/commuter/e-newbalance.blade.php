@extends('layouts.app')

@section('css')
@isset($css)
@foreach($css as $c)
<link href="{{ asset('css/'.$c.'.css') }}" rel="stylesheet" type="text/css" />
@endforeach
@endisset
@endsection

@section('content')
<commuter-e-newbalance :added-value="{{ json_encode($added_value) }}"
    :new-balance="{{ json_encode($new_balance) }}"></commuter-e-newbalance>
@endsection
