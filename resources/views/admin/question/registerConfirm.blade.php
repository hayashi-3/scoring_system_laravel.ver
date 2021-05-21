@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <h2>新規投稿確認画面</h2>
        <form method="POST" action="{{ route('question.store') }}">
        @csrf
            <div class="form-group">
                <label for="question">
                    問題
                </label>
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
                <a class="btn btn-secondary" href="{{ route('question.register') }}">
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