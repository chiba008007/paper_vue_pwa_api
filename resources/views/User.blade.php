<script type="text/javascript">
function change(){
    let sel = document.getElementById("company_count").value;
    location.href = location.pathname+"?sel="+sel;
}
function skillChange(){
    let sel = document.getElementById("skill_count").value;
    location.href = location.pathname+"?skillsel="+sel;
}
function historyChange(){
    let sel = document.getElementById("history_count").value;
    location.href = location.pathname+"?historysel="+sel;
}
</script>
<div style="width:1500px;">
    <div style="width:300px;float:left;">
        <a href="/list">一覧に戻る</a>
        <h4>基本情報</h4>
        {{ $users->id }}
        <form action="" method="post" enctype="multipart/form-data" >
            @csrf
            <input type="submit" name="basic_button" value="更新" />
            <br />
            パスワード<br />
            <input type="text" name="password" value="" />
            <br />
            code<br />
            <input type="text" name="code" value="{{ $users->code }}" />
            <br />
            表示名<br />
            <input type="text" name="display_name" value="{{ $users->display_name }}" />
            <br />
            所属<br />
            <input type="text" name="syozoku" value="{{ $users->syozoku }}" />
            <br />
            ふりがな<br />
            <input type="text" name="kana" value="{{ $users->kana }}" />
            <br />
            自己画像アップロード<br />
            <div >
                <img src="{{ $users->myimage_path }}" width=200 />
            </div>
            <input type="file" name="myimage_path"  />
            <br />
            会社名<br />
            <input type="text" name="company_name" value="{{ $users->company_name }}" />
            <br />
            会社ロゴアップロード<br />
            <div >
                <img src="{{ $users->company_image_path }}" width=200 />
            </div>
            <input type="file" name="company_image_path"  />
            <br />
            会社URL<br />
            <input type="text" name="company_url" value="{{ $users->company_url }}" />
            <br />
            電話番号<br />
            <input type="text" name="tel" value="{{ $users->tel }}" />
            <br />
            メールアドレス<br />
            <input type="text" name="email" value="{{ $users->email }}" />
            <br />
            自己PR<br />
            <textarea  name="profile" style="width:200px;height:200px" >{{ $users->profile }}</textarea>
            <br />
        </form>
    </div>
    <div style="width:300px;float:left;">
        <h4>会社情報</h4>
        表示数
        <select name="company_count" id="company_count" onChange="change()">
            @for ($i=0;$i<=10;$i++)
                @php $sel = ""; @endphp
                @if($i == $users->users_companies->count)
                @php $sel = "selected"; @endphp
                @endif

                <option value="{{ $i }}" {{ $sel }}>{{ $i }}</option>
            @endfor
        </select>
        <form action="" method="post" >
            @csrf
            <input type="submit" name="company_button" value="更新" />
            @for($i=0;$i<$users->users_companies->count;$i++)
            <div>
                No{{ $i+1 }}.会社住所<br />
                <textarea name="address[{{ $i }}]" style="width:100%;height:200px">{{  @$users->users_companies[$i]->address }}</textarea>
                <br />地図表示住所<br />
                <input type="text" name="map_url[{{ $i }}]" value="{{  @$users->users_companies[$i]->map_url }}" />
            </div>
            @endfor
        </form>
    </div>
    <div style="width:300px;float:left;">
        <h4>スキル</h4>
        表示数
         <select name="skill_count" id="skill_count" onChange="skillChange()">
            @for ($i=0;$i<=10;$i++)
                @php $sel = ""; @endphp
                @if($i == $users->users_skill->count)
                @php $sel = "selected"; @endphp
                @endif

                <option value="{{ $i }}" {{ $sel }}>{{ $i }}</option>
            @endfor
        </select>
        <form action="" method="post" >
            @csrf
            <input type="submit" name="user_skills" value="更新" />

            @for($i=0;$i<$users->users_skill->count;$i++)
            <div>
                No{{ $i+1 }}.スキル<br />
                <input type="text" name="note[{{ $i }}]" value="{{  @$users->users_skill[$i]->note }}" style="width:100%;" />
            </div>
            @endfor
        </form>
    </div>
    <div style="width:300px;float:left;">
        <h4>経歴</h4>
        表示数
        <select name="history_count" id="history_count" onChange="historyChange()">
            @for ($i=0;$i<=10;$i++)
                @php $sel = ""; @endphp
                @if($i == $users->users_histories->count)
                @php $sel = "selected"; @endphp
                @endif

                <option value="{{ $i }}" {{ $sel }}>{{ $i }}</option>
            @endfor
        </select>
        <form action="" method="post" >
            @csrf
            <input type="submit" name="user_history" value="更新" />
            @for($i=0;$i<$users->users_histories->count;$i++)
            <div>
                No{{ $i+1 }}.経歴<br />
                <input type="text" name="title[{{ $i }}]" value="{{  @$users->users_histories[$i]->title }}" />
                <br />
                内容<br />
                <textarea name="note[{{ $i }}]" style="width:100%;height:200px">{{  @$users->users_histories[$i]->note }}</textarea>
            </div>
            @endfor
        </form>
    </div>
</div>
