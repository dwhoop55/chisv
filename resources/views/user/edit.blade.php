@extends('layouts.app', ['title' => $user->lastname . ', ' . $user->firstname])

@section('content')

<div class="columns is-centered">
    <div class="column is-two-thirds">
        @if($errors->any())
        <div class="notification is-danger">
            <p class="is-size-5 has-text-weight-bold">Some fields are invalid</p>
            @foreach ($errors->all() as $error)
            <p class="has-padding-l-5 haspadding-r-5"> {{ $error }} </p>
            @endforeach
        </div>
        @endif

        <form action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data" method="post">
            @method('PUT')
            @csrf

            <p class="buttons is-pulled-left has-margin-6">
                <a class="button is-rounded" href="{{ route('user.index', $user->id) }}">
                    <span class="icon">
                        <i class="mdi mdi-arrow-left"></i>
                    </span>
                </a>
            </p>

            <h1 class="title">{{ $user->firstname }} {{ $user->lastname }}</h1>
            <div class="subtitle field is-grouped is-grouped-multiline">
                <div class="control">
                    <div class="tags has-addons">
                        <span class="tag is-light">created</span>
                        <span class="tag is-white">
                            {{ $authUser->formatDate($user->created_at) }}
                        </span>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <span class="tag is-light">updated</span>
                        <span class="tag is-white">{{ $authUser->formatDate($user->updated_at) }}</span>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id" value="{{ $user->id }}">

            <div class="field is-grouped">
                <div class="control is-expanded">
                    <label class="label">Firstname</label>
                    <input required class="input" type="text" name="firstname"
                        class="@error('firstname') is-danger @enderror"
                        value="{{ old('firstname', $user->firstname) }}">
                </div>
                @error('firstname')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
                <div class="control is-expanded">
                    <label class="label">Lastname</label>
                    <input required class="input" type="text" name="lastname"
                        class="@error('lastname') is-danger @enderror" value="{{ old('lastname', $user->lastname) }}">
                </div>
                @error('lastname')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>


            <div class="field">
                <p class="control">
                    <label class="label">E-Mail</label>
                    <input required class="input" type="email" name="email" class="@error('email') is-danger @enderror"
                        value="{{ old('email', $user->email) }}">
                </p>
                @error('email')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field is-grouped">
                <div class="control is-expanded">
                    <label class="label">Languages</label>
                    <language-picker :selected="{{ old('languages', $user->languages) }}">
                    </language-picker>
                </div>
                @error('languages')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field is-grouped">
                <div class="control is-expanded">
                    <label class="label">City of residence (choose closest)</label>
                    <location-picker :selected="{{ old('location', $user->city->location()) }}">
                    </location-picker>
                </div>
                @error('location')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field is-grouped">
                <div class="control is-expanded">
                    <label class="label">University</label>
                    <university-picker :selected="{{ old('university', $user->university) }}">
                    </university-picker>
                </div>
                @error('university')
                <p class=" help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control is-expanded">
                    <label class="label">Degree program</label>
                    <div class="select">
                        <select name="degree_id">
                            <option>Choose..</option>
                            @foreach ($degrees as $degree)
                            <option value="{{ $degree->id }}"
                                {{ old('degree_id', $user->degree_id) == $degree->id ? 'selected' : '' }}>
                                {{ $degree->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('degree_id')
                <p class=" help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field is-grouped">
                <div class="control is-expanded">
                    <label class="label">Past conferences you have attended</label>
                    <input class="input" name="past_conferences" type="text"
                        class="@error('past_conferences') is-danger @enderror"
                        value="{{ old('past_conferences', $user->past_conferences) }}">
                </div>
                @error('past_conferences')
                <p class="help is-danger">{{ $message }}</p>
                @enderror

                <div class="control is-expanded">
                    <label class="label">Past conferences you have attended as SV</label>
                    <input class="input" name="past_conferences_sv" type="text"
                        class="@error('past_conferences_sv') is-danger @enderror"
                        value="{{ old('past_conferences_sv', $user->past_conferences_sv) }}">
                </div>
                @error('past_conferences_sv')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control is-expanded">
                    <label class="label">T-Shirt</label>
                    <div class="select">
                        <select name="shirt_id">
                            <option>Choose..</option>
                            @foreach ($shirts as $shirt)
                            <option value="{{ $shirt->id }}"
                                {{ old('shirt_id', $user->shirt_id) == $shirt->id ? 'selected' : '' }}>
                                {{ $shirt->cut }}
                                {{ $shirt->size }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('shirt_id')
                <p class=" help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="button is-success is-pulled-right has-margin-t-5 has-margin-b-5">Save</button>
        </form>

        @can('delete', $user)
        <button onclick="event.preventDefault(); $('#destroy-form').submit();"
            class="button is-danger is-pulled-right has-margin-5">Delete</button>
        @endcan

    </div>
</div>

<form id="destroy-form" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection