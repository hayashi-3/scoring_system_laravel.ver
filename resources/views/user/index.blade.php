@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    ログインしました!
                </div>

            </div>
            <div class="link">
                <a href="{{ action('Admin\ScoringController@test') }}">テストをする ></a><br>
                <a href="{{ action('Admin\HistoryController@historiesList') }}">過去の採点結果をみる ></a><br>
            </div>

        </div>
    </div>
</div>
@endsection
