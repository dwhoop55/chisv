@extends('layouts.app', ['title' => 'Create conference'])

@section('content')
<div class="card">
    <div class="card-header">{{ __('Add conference')}}</div>
    <div class="card-body">
        {{-- @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li> {{ $error}} </li>
        @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('conference.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}"
                value="{{ old('name') }}" id="name">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input name="slug" type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid':'' }}"
                value="{{ old('slug') }}" id="slug">
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input name="location" type="text" class="form-control {{ $errors->has('location') ? 'is-invalid':'' }}"
                value="{{ old('location') }}" id="location">
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input name="date" type="text" class="form-control {{ $errors->has('date') ? 'is-invalid':'' }}"
                value="{{ old('date') }}" id="date">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}"
                rows="5" id="description">{{ old('description') }}</textarea>
        </div>


        <button type="submit" class="btn btn-primary float-right">Add</button>
    </form> --}}
</div>
</div>
@endsection