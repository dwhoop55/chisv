@extends('layouts.app', ['title' => $conference->name])

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

        <form action="{{ route('conference.update', $conference->key) }}" method="post">
            @method('PUT')
            @csrf

            <p class="buttons is-pulled-left has-margin-6">
                <a class="button is-rounded" href="{{ route('conference.show', $conference->key) }}">
                    <span class="icon">
                        <i class="mdi mdi-arrow-left"></i>
                    </span>
                </a>
            </p>

            <h1 class="title">{{ $conference->name }}</h1>
            <div class="subtitle field is-grouped is-grouped-multiline">
                <div class="control">
                    <div class="tags has-addons">
                        <span class="tag is-light">created</span>
                        <span class="tag is-white">{{ date('d/m/Y H:m', strtotime($conference->created_at)) }}</span>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <span class="tag is-light">updated</span>
                        <span class="tag is-white">{{ date('d/m/Y H:m', strtotime($conference->updated_at)) }}</span>
                    </div>
                </div>
            </div>

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

            <div class="field">
                <label class="label">Timezone of Conference</label>
                <div class="control">
                    <timezone-picker :input-name="'timezone_id'"
                        :id="{{ old('timezone_id', $conference->timezone->id) }}" :timezones="{{ $timezones }}">
                    </timezone-picker>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-body">
                    <div class="field">
                        <label class="label">Start Date (in timezone above)</label>
                        <div class="control">
                            <day-picker :value="'{{ old('start_date', $conference->start_date) }}'"
                                :input-name="'start_date'">
                            </day-picker>
                        </div>
                        @error('start_date')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label">End Date (in timezone above)</label>
                        <div class="control">
                            <day-picker :value="'{{ old('end_date', $conference->end_date) }}'"
                                :input-name="'end_date'">
                            </day-picker>
                        </div>
                        @error('end_date')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Description</label>
                <div class="control">
                    <text-field :input-name="'description'"
                        :placeholder="'Give your SVs some small insight about the topics of the conference'"
                        :maxlength="'350'" :text="'{{ old('description', $conference->description) }}'"></text-field>
                    @error('description')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label">State</label>
                    <div class="select">
                        <select name="state_id" required>
                            @foreach ($states as $state)
                            <option value="{{ $state->id }}"
                                {{ old('state_id', $conference->state_id) == $state->id ? 'selected="selected"' : '' }}>
                                {{ ucwords($state->name) }} - {{ $state->description }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Bidding</label>
                    <simple-switch :input-name="'enable_bidding'"
                        :value="{{ old('enable_bidding', $conference->enable_bidding) ? "true" : "false" }}">
                    </simple-switch>
                </div>

                <button type="submit"
                    class="button is-primary is-pulled-right has-margin-t-5 has-margin-b-5">Save</button>
        </form>

        <form action="{{ route('conference.destroy', $conference->key) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="button is-danger is-pulled-right has-margin-5">Delete</button>
        </form>
    </div>
</div>


@endsection