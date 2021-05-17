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
                <a href="#">問題・答え登録 ></a><br>
                <a href="#">テストをする ></a><br>
                <a href="#">採点履歴 ></a>
            </div>

        </div>
    </div>
</div>
@endsection
