@extends('layouts.app', ['title' => 'Users'])

@section('content')

<users-table :users="{{ $users }}"></users-table>

@endsection