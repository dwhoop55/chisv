@extends('layouts.app')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li> {{ $error}} </li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('conference.update', $conference->key) }}" method="post">
    @method('PUT')
    @csrf

    <input type="hidden" name="id" value="{{ $conference->id }}">

    <div class="field">
        <label class="label">Name</label>
        <div class="control is-expanded">
            <input required class="input" type="text" name="name" class="@error('name') is-danger @enderror"
                value="{{ $conference->name }}">
        </div>
        @error('name')
        <p class="help is-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label class="label">Key (part of url)</label>
        <div class="control">
            <input required class="input" type="text" name="key" class="@error('key') is-danger @enderror"
                value="{{ $conference->key }}">
        </div>
        @error('key')
        <p class="help is-danger">{{ $message }}</p>
        @enderror
    </div>

    </div>
    {{-- 
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}"
    value="{{ $conference->name }}" id="name">
    </div>
    <div class="form-group">
        <label for="key">Key (changing this will break all URLs!)</label>
        <input name="key" type="text" class="form-control {{ $errors->has('key') ? 'is-invalid':'' }}"
            value="{{ $conference->key }}" id="key">
    </div>
    <div class="form-group">
        <label for="location">Location</label>
        <input name="location" type="text" class="form-control {{ $errors->has('location') ? 'is-invalid':'' }}"
            value="{{ $conference->location }}" id="location">
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input name="date" type="text" class="form-control {{ $errors->has('date') ? 'is-invalid':'' }}"
            value="{{ $conference->date }}" id="date">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}" rows="5"
            id="description">{{ $conference->description }}</textarea>
    </div>

    --}}

    <button type="submit" class="button is-primary is-pulled-right">Save</button>
</form>

<form action="{{ route('conference.destroy', $conference->key) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="button is-danger is-pulled-right">Delete</button>
</form>


@endsection