@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ $conference->name }}</div>
    <div class="card-body">
        @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error}} </li>
                    @endforeach
                    </ul>
                </div>
        @endif

        <form action="{{ route('conference.update', $conference->slug) }}" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $conference->id }}">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" value="{{ $conference->name }}" id="name">
            </div>
            <div class="form-group">
                    <label for="slug">Slug (changing this will break all URLs!)</label>
                    <input name="slug" type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid':'' }}" value="{{ $conference->slug }}" id="slug">
                </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input name="location" type="text" class="form-control {{ $errors->has('location') ? 'is-invalid':'' }}" value="{{ $conference->location }}" id="location">
            </div>
            <div class="form-group">
                    <label for="date">Date</label>
                    <input name="date" type="text" class="form-control {{ $errors->has('date') ? 'is-invalid':'' }}" value="{{ $conference->date }}" id="date">
               </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}" rows="5" id="description">{{ $conference->description }}</textarea>
            </div>

            
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </form>

        <form action="{{ route('conference.destroy', $conference->slug) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger float-left">Delete</button>
        </form>
    </div>
</div>
@endsection
