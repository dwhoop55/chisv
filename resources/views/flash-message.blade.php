@if ($message = Session::get('success'))
<flash-message :duration="5000" :type="'is-success'" :message="'{{ $message }}'"></flash-message>
@endif


@if ($message = Session::get('error'))
<flash-message :type="'is-danger'" :message="'{{ $message }}'"></flash-message>
@endif


@if ($message = Session::get('warning'))
<flash-message :type="'is-warning'" :message="'{{ $message }}'"></flash-message>
@endif


@if ($message = Session::get('info'))
<flash-message :duration="5000" :type="'is-info'" :message="'{{ $message }}'"></flash-message>
@endif


@if ($errors->any())
<flash-message :duration="5000" :type="'is-danger'" :message="'Please check below for errors'"></flash-message>
@endif