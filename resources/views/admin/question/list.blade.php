@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{ action('Admin\QuestionController@register') }}">新規登録</a>
  <div class="row justify-content-center">
    <table>
      <tr>
        <th>ID</th>
        <th>問題</th>
        <th>答え1</th>
        <th>答え2</th>
        <th></th>
      </tr>

      @foreach ($questions as $q)
      <tr>
        <td>{{ $q->id }}</td>
        <td>{{ $q->question }}</td>
        @foreach ($answers as $a)

        @if ($q->id === $a->questions_id)
        <td>{{ $a->answer }}</td>
        @endif
        @endforeach
        <td><button type="button" class="btn btn-primary" onclick="location.href='/admin/question/{{ $q->id }}/edit'">編集</button></td>
        <td><button type="button" class="btn btn-danger" onclick="location.href='/admin/question/{{ $q->id }}/destroyConfirm'">削除</button></td>
        </form>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
