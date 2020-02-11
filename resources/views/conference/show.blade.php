@extends('layouts.app', ['title' => $conference->name])

@section('content')
<conference conference-key="{{ $conference->key }}"></conference>
@endsection