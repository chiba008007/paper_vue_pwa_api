<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registed;
use App\Models\user_renew_pages;
use Illuminate\Support\Facades\Log;
use App\Consts\CommonConst;
use App\Mail\MailRegist;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRenewController extends Controller
{
    public function getRenewUserData(Request $request)
    {
        $code = $request->code;
        $userRenewPage = user_renew_pages::whereHas('user', function ($query) use ($code) {
            $query->where('status', 1)->where('display_flag', 1); // user.status = 1
        })
        ->whereHas('registed', function ($query) use ($code) {
            $query->where('code', $code); // registed.code = $code
        })
        ->with(['user', 'registed'])
        ->first();
        $userRenewPage->registed_code = optional($userRenewPage->registed)->code;
        return response($userRenewPage, 200);
    }
    public function editUserRenewPage(Request $request)
    {

        Log::debug('🟡 データ登録');
        Log::debug('🔍 all() 内容:', $request->all());

        $code = $request->input('code');
        $userId = $request->input('user_id');
        $userdata = User::where('id', $userId)->first();
        if (!$userdata) {
            Log::error('userテーブルデータがありません。');
            return response()->json(['error' => 'Users not found'], 404);
        }

        // ① registed を code から取得
        $registed = Registed::where('code', $code)->first();
        if (!$registed) {
            Log::error('registedテーブルデータがありません。');
            return response()->json(['error' => 'Registed not found'], 404);
        }

        DB::beginTransaction();
        try {
            // ② user_renew_pages を user_id で取得
            $page = user_renew_pages::where('user_id', $userId)
                ->where('registed_id', $registed->id)
                ->first();
            if (!$page) {
                Log::error('UserRenewPageテーブルデータがありません。');
                return response()->json(['error' => 'UserRenewPage not found'], 404);
            }


            $page->section1 = $request->input('section1');
            $page->section2 = $request->input('section2');
            $page->section3 = $request->input('section3');
            $page->section4 = $request->input('section4');
            $page->section5 = $request->input('section5');
            $page->section6 = $request->input('section6');
            $page->top = $request->input('top');
            $page->updateTopImage_checked = $request->input('updateTopImage_checked');
            $page->human = $request->input('human');
            $page->humanImage_checked = $request->input('humanImage_checked');
            $page->ya_image = $request->input('ya_image');
            $page->title1_image = $request->input('title1_image');
            $page->title1_image_checked = $request->input('title1_image_checked');
            $page->image1 = $request->input('image1');
            $page->image2 = $request->input('image2');
            $page->image3 = $request->input('image3');
            $page->image4 = $request->input('image4');
            $page->image5 = $request->input('image5');
            $page->image1_checked = $request->input('image1_checked');
            $page->image2_checked = $request->input('image2_checked');
            $page->image3_checked = $request->input('image3_checked');
            $page->image4_checked = $request->input('image4_checked');
            $page->image5_checked = $request->input('image5_checked');
            $page->text1 = $request->input('text1');
            $page->text2 = $request->input('text2');
            $page->text3 = $request->input('text3');
            $page->text4 = $request->input('text4');
            $page->name = $request->input('name');
            $page->kana = $request->input('kana');
            $page->mail = $request->input('mail');
            $page->title1 = $request->input('title1');
            $page->text5 = $request->input('text5');
            $page->text6 = $request->input('text6');
            $page->text7 = $request->input('text7');
            $page->text8 = $request->input('text8');
            $page->text9 = $request->input('text9');
            $page->text10 = $request->input('text10');
            $page->text11 = $request->input('text11');
            $page->text12 = $request->input('text12');
            $page->text13 = $request->input('text13');
            $page->text14 = $request->input('text14');
            $page->text15 = $request->input('text15');
            $page->text16 = $request->input('text16');
            $page->text17 = $request->input('text17');
            $page->text18 = $request->input('text18');
            $page->text19 = $request->input('text19');
            $page->text20 = $request->input('text20');
            $page->text21 = $request->input('text21');
            $page->text22 = $request->input('text22');
            $page->text23 = $request->input('text23');
            $page->textarea1 = $request->input('textarea1');
            $page->text24 = $request->input('text24');
            $page->text25 = $request->input('text25');
            $page->charttitle = $request->input('charttitle');
            $page->pietitle1 = $request->input('pietitle1');
            $page->pietitle2 = $request->input('pietitle2');
            $page->textarea2 = $request->input('textarea2');
            $page->title2 = $request->input('title2');
            $page->button_label = $request->input('button_label');
            $page->button_link = $request->input('button_link');
            $page->button_text = $request->input('button_text');
            $page->title3 = $request->input('title3');
            $page->title4 = $request->input('title4');
            $page->text26 = $request->input('text26');
            $page->money = $request->input('money');
            $page->text27 = $request->input('text27');
            $page->title5 = $request->input('title5');
            $page->title6 = $request->input('title6');
            $page->text28 = $request->input('text28');
            $page->contact_mail = $request->input('contact_mail');
            $page->contact_tel = $request->input('contact_tel');

            // JSON系
            $page->chart_labels = $request->input('chart_labels');
            $page->chart_data = $request->input('chart_data');
            $page->pie_labels = $request->input('pie_labels');
            $page->pie_data = $request->input('pie_data');
            $page->pie2_labels = $request->input('pie2_labels');
            $page->pie2_data = $request->input('pie2_data');
            $page->chip_title = $request->input('chip_title');
            $page->chip_title2 = $request->input('chip_title2');
            $page->chip_title3 = $request->input('chip_title3');
            $page->chip_body = $request->input('chip_body');
            $page->items = $request->input('items');
            $page->tables = $request->input('tables');
            $page->comments = $request->input('comments');
            $page->sns = $request->input('sns');

            // 最後に保存
            $page->save();

            // ⑤ users テーブルのステータスも更新
            $user = User::find($userId);
            if (!$user) {
                throw new \Exception('User not found');
            }
            if ($request->input('routeName') == "register") {
                $user->status = 2;
            }
            $user->save();

            // ⑥ コミット
            DB::commit();
            if ($request->input('routeName') == "register") {
                $data = [];
                $data[ 'email' ] = $userdata->email;
                $data[ 'name' ] = $userdata->name;
                $data[ 'subject' ] = "新規申し込みありがとうございます。";
                Mail::send(new MailRegist($data));

                $data[ 'email' ] = CommonConst::ADMINMAIL;
                $data[ 'subject' ] = "新規申し込みがありました。パスワード[password]";
                Mail::send(new MailRegist($data));
            }
            return response()->json(['message' => '更新が完了しました']);

        } catch (\Exception $e) {
            DB::rollBack(); // エラー時にロールバック

            return response()->json([
                'error' => '更新に失敗しました',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
