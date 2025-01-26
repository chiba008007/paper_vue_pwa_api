@extends('layout.default')

@include('common.header')

@section('content')
stripeで支払い確認ができたらステータスを利用中に変更します。
<br />
■テストURL<br />
https://dashboard.stripe.com/test/payments<br />

chiba00807@gmail.com / Takahiro1234
<br />
<h1>ユーザ一覧画面</h1>
<a href="">新規作成</a>
<form action="/list" method=post>
    @csrf
    変更対象のIDを指定<br />
    <input type="text" name="id" value="{{ old('id') }}" required />
    <input type="submit" name="regist" value="更新" />
    <table border=1>
    <tr>
        <td>ID</td>
        <td>利用者用URL</td>
        <td>利用者名</td>
        <td>メールアドレス</td>
        <td>名刺送付先住所</td>
        <td>ステータス</td>
        <td>表示</td>
        <td>登録日</td>
        <td>機能</td>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $users->domain }}/?code={{ $user->code }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->registed_post }}<br />{{ $user->registed_pref }}{{ $user->registed_address }}</td>
        <td>
            <select name="status[{{ $user->id }}]">
                @foreach($commonValue as $key=>$value)
                <option value="{{ $key }}" @if($user->status == $key) selected @endif >{{ $value }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="display_flag[{{ $user->id }}]">
                @foreach($displayValue as $key=>$value)
                <option value="{{ $key }}" @if($user->display_flag == $key) selected @endif >{{ $value }}</option>
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
