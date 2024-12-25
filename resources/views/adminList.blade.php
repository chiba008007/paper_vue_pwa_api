@extends('layout.default')

@include('common.header')

@section('content')
<h1>ユーザ一覧画面</h1>
<a href="">新規作成</a>
<form action="/list" method=post>
    @csrf
    <input type="submit" name="regist" value="更新" />
    <table border=1>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->code }}</td>
        <td>{{ $user->name }}</td>
        <td>
            <select name="status[{{ $user->id }}]">
                @foreach($commonValue as $key=>$value)
                <option value="{{ $key }}" @if($user->status == $key) selected @endif >{{ $value }}</option>
                @endforeach
            </select>
        </td>
        <td>{{ $user->created_at }}</td>
        <td>
            <a href="{{ route('edit',['id' => $user->id]) }}">更新</a>
            <a href="">削除</a>
        </td>
    </tr>
    @endforeach
    </table>
</form>

@endsection

@include('common.footer')
