@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8 col-md-offset-2">
          <h2>編集フォーム</h2>

          <form method="POST" action="{{ route('question.editPost') }}">
          @csrf

              <div class="form-group">
                <label for="question">
                    問題
                </label>
                <input
                    name="id"
                    class="form-control"
                    value="{{ $question->id }}"
                    type="hidden"
                >
                <textarea
                    name="question"
                    class="form-control"
                    rows="4"
                >{{ $question->question }}</textarea>
                @if ($errors->has('question'))
                    <div class="text-danger">
                        <p>入力必須項目です。500文字以内で入力してください。</p>
                    </div>
                @endif
              </div>

              @foreach ($answers as $a)
              <div class="form-group">
                <label for="answers">
                    答え:
                </label>
                <input
                    name="answers[]"
                    class="form-control"
                    value="{{ $a->answer }}"
                    type="text"
                >
                @if ($errors->has('answers.*'))
                    @foreach ($errors->get('answers.*') as $messages)
                        <div class="text-danger">
                            <p>この項目は入力必須です。200文字以内で入力してください。</p>
                        </div>
                    @endforeach
                @endif
              </div>
              @endforeach

              <div class="mt-5">
                  <a class="btn btn-secondary" href="{{ route('list') }}">
                      キャンセル
                  </a>
                  <button type="submit" class="btn btn-primary">
                      確認
                  </button>
              </div>

          </form>
      </div>
  </div>
</div>
@endsection