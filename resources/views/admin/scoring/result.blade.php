@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>{{ $user->name }}さん</p>
            <p>{{ $q_count }}問中{{ $score }}問正解です。</p>
            <p>{{ $result }}点でした。</p>
            <!-- 現在時刻 -->
            <p>{{ \Carbon\Carbon::now() }}</p>
        </div>
    </div>
</div>
@endsection
