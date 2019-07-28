@extends('layouts.app')
@section('content')


<div class="container">
    <div class="columns is-centered">
        <div class="column is-three-quarters">
            <div class="form-card">
                <div class="form-title">
                    <h1>Sign up</h1>
                </div>
                <div class="form-content">
                    @if($errors->any())
                    <div class="notification is-danger">
                        <p class="is-size-5 has-text-weight-bold">Some fields are invalid</p>
                        @foreach ($errors->all() as $error)
                        <p class="has-padding-l-5 haspadding-r-5"> {{ $error}} </p>
                        @endforeach
                    </div>
                    @endif

                    <form method="POST" action="{{ route('register.create') }}">
                        @csrf


                        <div class="field is-grouped">
                            <div class="control is-expanded">
                                <label class="label">Firstname</label>
                                <input required class="input" type="text" name="firstname"
                                    class="@error('firstname') is-danger @enderror" value="{{ old('firstname') }}">
                            </div>
                            @error('firstname')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror
                            <div class="control is-expanded">
                                <label class="label">Lastname</label>
                                <input required class="input" type="text" name="lastname"
                                    class="@error('lastname') is-danger @enderror" value="{{ old('lastname') }}">
                            </div>
                            @error('lastname')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="field">
                            <p class="control has-icon has-icons-left">
                                <label class="label">E-Mail</label>
                                <input required class="input" type="email" name="email"
                                    class="@error('email') is-danger @enderror" value="{{ old('email') }}">
                            </p>
                            @error('email')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field is-grouped">
                            <div class="control is-expanded">
                                <label class="label">Languages</label>
                                <language-picker :selected="{{ old('languages', '[]') }}">
                                </language-picker>
                            </div>
                            @error('languages')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field is-grouped">
                            <div class="control is-expanded">
                                <label class="label">City of residence (choose closest)</label>
                                <location-picker :selected="{{ old('location', 'null') }}">
                                </location-picker>
                            </div>
                            @error('location')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field is-grouped">
                            <div class="control is-expanded">
                                <label class="label">University</label>
                                <university-picker :selected="{{ old('university', 'null') }}">
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
                                            {{ old('degree_id') == $degree->id ? 'selected' : '' }}>
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
                                <input class="input" name="pastConferences" type="text"
                                    class="@error('pastConferences') is-danger @enderror"
                                    value="{{ old('pastConferences') }}">
                            </div>
                            @error('pastConferences')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror

                            <div class="control is-expanded">
                                <label class="label">Past conferences you have attended as SV</label>
                                <input class="input" name="pastConferencesAsSv" type="text"
                                    class="@error('pastConferencesAsSv') is-danger @enderror"
                                    value="{{ old('pastConferencesAsSv') }}">
                            </div>
                            @error('pastConferencesAsSv')
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
                                            {{ old('shirt_id') == $degree->id ? 'selected' : '' }}>{{ $shirt->cut }}
                                            {{ $shirt->size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('shirt_id')
                            <p class=" help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field is-grouped">
                            <div class="control is-expanded">
                                <label class="label">Password</label>
                                <input required class="input" type="password" name="password"
                                    class="@error('password') is-danger @enderror">
                            </div>
                            @error('password')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror
                            <div class="control is-expanded">
                                <label class="label">Confirm Password</label>
                                <input required class="input" type="password" name="password_confirmation"
                                    class="@error('password_confirmation') is-danger @enderror">
                            </div>
                            @error('password_confirmation')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="button is-pulled-right is-primary" type="submit">Sign up</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection