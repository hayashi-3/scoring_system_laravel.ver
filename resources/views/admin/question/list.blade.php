@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <a href="{{ action('Admin\QuestionController@register') }}">新規登録</a>
      <label>問題：</label>
      <label>答え１：</label>
      <label>答え２：</label>
    </div>
</div>
@endsection
