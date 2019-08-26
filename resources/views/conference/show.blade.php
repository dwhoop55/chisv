@extends('layouts.app', ['title' => $conference->name])

@section('content')
<conference-show :conference="{{ $conference }}"></conference-show>
@endsection