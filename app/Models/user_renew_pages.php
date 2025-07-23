<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_renew_pages extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'registed_id',
        'section1',
        'section2',
        'section3',
        'section4',
        'section5',
        'section6',
        'top',
        'updateTopImage_checked',
        'human',
        'humanImage_checked',
        'ya_image',
        'title1_image',
        'title1_image_checked',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'image1_checked',
        'image2_checked',
        'image3_checked',
        'image4_checked',
        'image5_checked',
        'text1',
        'text2',
        'text3',
        'text4',
        'name',
        'kana',
        'mail',
        'title1',
        'text5',
        'text6',
        'text7',
        'text8',
        'text9',
        'text10',
        'text11',
        'text12',
        'text13',
        'text14',
        'text15',
        'text16',
        'text17',
        'text18',
        'text19',
        'text20',
        'text21',
        'text22',
        'text23',
        'textarea1',
        'text24',
        'text25',
        'charttitle',
        'pietitle1',
        'pietitle2',
        'textarea2',
        'title2',
        'button_label',
        'button_link',
        'button_text',
        'title3',
        'title4',
        'text26',
        'money',
        'text27',
        'title5',
        'title6',
        'text28',
        'contact_mail',
        'contact_tel',
        'chart_labels',
        'chart_data',
        'pie_labels',
        'pie_data',
        'pie2_labels',
        'pie2_data',
        'chip_title',
        'chip_title2',
        'chip_title3',
        'chip_body',
        'items',
        'tables',
        'comments',
        'sns',
    ];

    protected $casts = [
        'chart_labels' => 'array',
        'chart_data' => 'array',
        'pie_labels' => 'array',
        'pie_data' => 'array',
        'pie2_labels' => 'array',
        'pie2_data' => 'array',
        'chip_title' => 'array',
        'chip_title2' => 'array',
        'chip_title3' => 'array',
        'chip_body' => 'array',
        'items' => 'array',
        'tables' => 'array',
        'comments' => 'array',
        'sns' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registed()
    {
        return $this->belongsTo(Registed::class);
    }

}
