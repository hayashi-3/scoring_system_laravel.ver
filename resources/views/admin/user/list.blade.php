@extends('layouts.app')

@section('content')
  <div>
    <a href="{{ action('AdminController@create') }}">新規登録</a>
    <label>問題：</label>
    <label>答え１：</label>
    <label>答え２：</label>
  </div>
@endsection