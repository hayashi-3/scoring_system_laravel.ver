@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8 col-md-offset-2">
          <h2>新規投稿フォーム</h2>
          <form method="POST" action="{{ route('question.post') }}">
          @csrf
              <div class="form-group">
                  <label for="question">
                      問題
                  </label>
                  <textarea
                      name="question"
                      class="form-control"
                      rows="4"
                  >{{ old('question') }}</textarea>
                  @if ($errors->has('question'))
                      <div class="text-danger">
                          <p>入力必須項目です。500文字以内で入力してください。</p>
                      </div>
                  @endif
              </div>
              <div class="form-group">
                  <label for="answers">
                      答え1:
                  </label>
                  <input
                      name="answers[]"
                      class="form-control"
                      value="{{ old('answers.0') }}"
                      type="text"
                  >
                  @if ($errors->has('answers.0'))
                      <div class="text-danger">
                        <p>入力必須項目です。200文字以内で入力してください。</p>
                      </div>
                  @endif
              </div>
              <div class="form-group">
                  <label for="answers">
                      答え2:
                  </label>
                  <input
                      name="answers[]"
                      class="form-control"
                      value="{{ old('answers.1') }}"
                      type="text"
                  >
                  @if ($errors->has('answers.1'))
                      <div class="text-danger">
                        <p>入力必須項目です。200文字以内で入力してください。</p>
                      </div>
                  @endif
              </div>
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