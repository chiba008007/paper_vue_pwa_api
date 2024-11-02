@extends('layout.default')

@include('common.header')

@section('content')
<h1>ユーザ一覧画面</h1>

<table>

@foreach ($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->created_at }}</td>
</tr>
@endforeach
</table>


@endsection

@include('common.footer')
