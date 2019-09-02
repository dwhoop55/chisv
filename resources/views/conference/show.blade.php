@extends('layouts.app', ['title' => $conference->name])

@section('content')
<conference-show conference-key="{{ $conference->key }}"></conference-show>
@endsection