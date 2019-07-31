@extends('layouts.app', ['title' => $conference->name])

@section('content')


<section class="section">

    @can('update', $conference)
    <div class="container is-topmost">
        <div class="field">
            <a class="button is-pulled-right" href="{{ route('conference.edit', $conference->key) }}">Settings</a>
        </div>
    </div>
    @endcan

    <h2 class="is-marginless columns is-vcentered has-text-weight-bold has-text-grey-darker">
        {{ $conference->name }}

        @if ($conference->enable_bidding)
        <div class="tags has-addons">
            @endif
            <span class="tag has-margin-l-7 is-rounded @switch($conference->state->id)
                                @case($overState->id)
                                is-light
                                @break
                                @case($planningState->id)
                                is-danger
                                @break
                                @default
                                is-success
                                @endswitch">{{ ucwords($conference->state->name) }}
            </span>
            @if ($conference->enable_bidding)
            <span class="tag is-rounded is-success"> Bidding open </span>
        </div>
        @endif
    </h2>

    <p class="has-text-weight-semibold has-text-black-ter"> {{ $conference->location }}&nbsp;
        {{ $user->formatDate($conference->start_date, $user->date_format) }} –
        {{ $user->formatDate($conference->end_date, $user->date_format) }}</p>
    </p>
    <p class="has-padding-t-7 has-text-weight-medium has-text-black-ter">{{ $conference->description }}</p>
</section>

<section class="section box">
    <h1 class="title">SV Status</h1>
    @if ($user->isSv($conference))
    <p>You are currently <strong>{{ $user->svStateFor($conference)->name }}</strong></p>
    @else
    <p>You are not enrolled</p>
    @endif
</section>

<section class="section box">
    @if($errors->any())
    <div class="notification is-danger">
        @foreach ($errors->all() as $error)
        <b-notification type="is-danger" has-icon aria-close-label="Close notification" role="alert">
            {{ $error }}
        </b-notification>
        @endforeach
    </div>
    @endif

    <h1 class="title">Actions</h1>
    <div class="field has-addons">

        {{-- Enrollment --}}
        @can('enroll', $conference)
        <p class="control">
            <a class="button is-medium is-primary" onclick="event.preventDefault();
                    $('#enroll-form').submit();">
                <span class="icon is-large">
                    <i class="mdi mdi-account-plus"></i>
                </span>
                <span>Enroll for {{ $conference->key }}</span>
            </a>
        </p>
        @elsecan('unenroll', $conference)
        <p class="control">
            <a class="button is-medium is-danger" onclick="event.preventDefault();
                        $('#unenroll-form').submit();">
                <span class="icon is-large">
                    <i class="mdi mdi-account-minus"></i>
                </span>
                <span>Unenroll from {{ $conference->key }}</span>
            </a>
        </p>
        @else
        <p class="control">
            <a class="button is-primary is-medium" disabled>
                <span class="icon is-large">
                    <i class="mdi mdi-account"></i>
                </span>
                <span>You are {{ $user->svStateFor($conference)->name }}</span>
            </a>
        </p>
        @endcan

    </div>

</section>

<form id="enroll-form" action="{{ route('conference.enroll', $conference->key) }}" method="POST" style="display: none;">
    @csrf</form>
<form id="unenroll-form" action="{{ route('conference.unenroll', $conference->key) }}" method="POST"
    style="display: none;">
    @csrf</form>

@endsection