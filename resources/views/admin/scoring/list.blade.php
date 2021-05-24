@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <form method="POST" action="{{ route('test.scoring') }}">
        @csrf
        <table>
          <tr>
            <th>ID</th>
            <th>問題</th>
            <th>答え</th>
            <th></th>
          </tr>

        @foreach ($questions as $q)
          <tr>
            <input type="hidden" name="ids[]" value="{{ $q->id }}">
            <td>{{ $q->id }}</td>
            <td>{{ $q->question }}</td>
            @foreach ($q->correctAnswers as $answers)
                <input type="text" name="answer_ids[]" value="{{ $answers->id }}">
            @endforeach
              <td><input type="text" name="answers[]"></td>
          </tr>
        @endforeach
        <td>
          <button type="submit" class="btn btn-primary">
            採点
          </button>
        </td>
      </form>
    </table>
  </div>
</div>
@endsection
