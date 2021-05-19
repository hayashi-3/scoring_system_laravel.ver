@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <h2>編集内容確認</h2>
        <form method="POST" action="{{ route('question.update') }}">
        @csrf
            <div class="form-group">
                <label for="question">
                    問題
                </label>
                <input
                  name="id"
                  class="form-control"
                  value="{{ $input['id'] }}"
                  type="hidden"
                >
                <textarea
                  name="question"
                  class="form-control"
                  rows="4"
                  readonly
                >{{ $input["question"] }}</textarea>
            </div>

            @foreach ($input['answers'] as $answer)
            <div class="form-group">
                <label for="answers">
                    答え:
                </label>
                <input
                  name="answers[]"
                  class="form-control"
                  type="text"
                  value="{{ $answer }}"
                  readonly
                >
            </div>
            @endforeach

            <div class="mt-5">
                <a class="btn btn-secondary" href="/admin/question/{{ $input['id'] }}/edit">
                  キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                  登録
                </button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection