@extends('layouts.app')

@section('content')
<login-cp csrf_token="{{ @csrf_token() }}"></login-cp>
@endsection
