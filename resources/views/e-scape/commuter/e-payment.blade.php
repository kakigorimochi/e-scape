@extends('layouts.app')

@section('css')
@isset($css)
@foreach($css as $c)
<link href="{{ asset('css/'.$c.'.css') }}" rel="stylesheet" type="text/css" />
@endforeach
@endisset
@endsection

@section('content')
<commuter-e-payment :journey="{{ json_encode($journey) }}"
	:uuid="{{ json_encode($uuid) }}" :wallet="{{ json_encode($wallet) }}">
</commuter-e-payment>
@endsection
