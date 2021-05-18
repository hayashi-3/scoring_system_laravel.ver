@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{ action('Admin\QuestionController@register') }}">新規登録</a>
  <div class="row justify-content-center">
    <table>
      <tr>
        <th>問題</th>
        <th>答え</th>
        <th></th>
      </tr>

      @foreach ($questions as $q)
      <tr>
        <td>問題：{{ $q->question }}</td>
        @foreach ($answers as $a)

        @if ($q->id === $a->questions_id)
        <td>答え：{{ $a->answer }}</td>
        @endif
      </tr>
    </table>
    @endforeach
    @endforeach
  </div>
</div>
@endsection
