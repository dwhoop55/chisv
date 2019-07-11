@extends('layouts.app', ['title' => $conference->name])

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

<div class="columns is-centered">
    <div class="column is-two-thirds">
        <form action="{{ route('conference.update', $conference->key) }}" method="post">
            @method('PUT')
            @csrf

            <input type="hidden" name="id" value="{{ $conference->id }}">

            <div class="field">
                <label class="label">Name</label>
                <div class="control is-expanded">
                    <input required class="input" type="text" name="name" class="@error('name') is-danger @enderror"
                        value="{{ old('name', $conference->name) }}">
                </div>
                @error('name')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Key (part of url)</label>
                <div class="control">
                    <input required class="input" type="text" name="key" class="@error('key') is-danger @enderror"
                        value="{{ old('key', $conference->key) }}">
                </div>
                @error('key')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Location</label>
                <div class="control">
                    <input required class="input" type="text" name="location" placeholder="Country, City"
                        class="@error('location') is-danger @enderror"
                        value="{{ old('location', $conference->location) }}">
                </div>
                @error('location')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            {{$conference->endDate}}
            <div class="field is-horizontal">
                <div class="field-body">
                    <div class="field">

                        <div class="control">
                            <day-picker :value="'{{ old('startDate', $conference->start_date) }}'"
                                :input-name="'startDate'">
                            </day-picker>
                        </div>
                        @error('startDate')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <div class="control">
                            <day-picker :value="'{{ old('endDate', $conference->end_date) }}'" :input-name="'endDate'">
                            </day-picker>
                        </div>
                        @error('endDate')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="button is-primary is-pulled-right has-margin-t-5 has-margin-b-5">Save</button>
        </form>

        <form action="{{ route('conference.destroy', $conference->key) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="button is-danger is-pulled-right has-margin-5">Delete</button>
        </form>
    </div>
</div>


@endsection