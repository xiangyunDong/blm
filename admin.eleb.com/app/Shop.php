<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable=['shop_category_id','shop_name','shop_img','shop_rating',
        'brand','on_time','fengniao','bao',
        'piao','zhun','start_send','start_send',
        'send_cost','notice','discount','status'
        ];

    public function shop_category(){
        return $this->belongsTo(ShopCategory::class);
    }

}


