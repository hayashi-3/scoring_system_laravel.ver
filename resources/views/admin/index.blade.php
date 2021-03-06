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
            <h3>管理者ページ</h3>
            <div class="link">
                <a href="list">問題と答えを確認・登録する ></a><br>
                <a href="{{ action('Admin\ScoringController@test') }}">テストをする ></a><br>
                <a href="{{ action('Admin\HistoryController@historiesList') }}">過去の採点結果をみる ></a><br>
                <a href="/admin/user/list">ユーザーを登録する ></a>
            </div>

        </div>
    </div>
</div>
@endsection
