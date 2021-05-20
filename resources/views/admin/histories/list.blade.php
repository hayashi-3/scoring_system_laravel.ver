@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <table>
      <tr>
        <th>名前</th>
        <th>得点</th>
        <th>採点日時</th>
      </tr>

      @foreach ($histories as $h)
      <tr>
        <td>{{ $user['name'] }}</td>
        <td>{{ $h->point }}</td>
        <td>{{ $h->created_at }}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
