@extends('layout.default')

@include('common.header')

@section('content')
<h1>ユーザ一覧画面</h1>
<a href="">新規作成</a>
<table>
@foreach ($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $commonValue[$user->status] }}</td>
    <td>{{ $user->created_at }}</td>
    <td>
        <a href="">更新</a>
        <a href="">削除</a>
    </td>
</tr>
@endforeach
</table>


@endsection

@include('common.footer')
