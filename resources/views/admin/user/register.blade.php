@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>新規投稿フォーム</h2>
        <form method="POST" action="{{ route('register_confirm') }}">
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
                        {{ $errors->first('question') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="answers">
                    答え
                </label>
                <input
                    name="answers"
                    class="form-control"
                    value="{{ old('answers') }}"
                    type="text"
                >
                @if ($errors->has('answers'))
                    <div class="text-danger">
                        {{ $errors->first('answers') }}
                    </div>
                @endif
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('admin.list') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    確認
                </button>
            </div>
        </form>
    </div>
</div>
@endsection