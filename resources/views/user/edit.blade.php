@extends('layouts.app', ['title' => $user->lastname . ', ' . $user->firstname])

@section('content')

<div class="columns is-centered">
    <div class="column is-two-thirds">
        @if($errors->any())
        <div class="notification is-danger">
            <p class="is-size-5 has-text-weight-bold">Some fields are invalid</p>
            @foreach ($errors->all() as $error)
            <p class="has-padding-l-5 haspadding-r-5"> {{ $error}} </p>
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


            <div class="field is-grouped">
                <div class="control is-expanded">
                    <label class="label">Email</label>
                    <input required class="input" type="text" name="email" class="@error('email') is-danger @enderror"
                        value="{{ old('email', $user->email) }}">
                </div>
                @error('email')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field is-grouped">
                <div class="control is-expanded">
                    <label class="label">Languages</label>
                    <language-picker :selected={{ old('languages', $user->languages) }}>
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
                    <university-picker :selected="{{ old('university', $user->university) }}>
                    </university-picker>
                </div>
                @error('university')
                <p class=" help is-danger">{{ $message }}</p>
                        @enderror
                </div>

        </form>
    </div>
</div>

@endsection