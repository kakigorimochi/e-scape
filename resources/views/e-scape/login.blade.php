@extends('layouts.app')

@section('css')
@isset($css)
@foreach($css as $c)
<link href="{{ asset('css/'.$c.'.css') }}" rel="stylesheet" type="text/css" />
@endforeach
@endisset
@endsection

@section('content')
<login :user-type="{{ json_encode($user_type) }}"></login>
@endsection
