<?php

namespace Modules\ProductCat\Models;

use App\Trait\DateConvert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ProductCat\Database\Factories\ProductCatFactory;

class ProductCat extends Model
{
    use HasFactory,DateConvert,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'seo_title',
        'seo_url',
        'pic',
        'parent_id',
        'state',
    ];
    public static function boot(){

        parent::boot();
        //soft Delete   
        static::deleted(function($product_cat)
        {
            dd("r4r5tyuiop[");
            $product_cat->sub_cats()->each(function($sub_product_cat) {
                dd($sub_product_cat);
                $sub_product_cat->update(["parent_id"=>null]);
            });

        });

    }
    protected static function newFactory(): ProductCatFactory
    {
        return ProductCatFactory::new();
    }

    public function sub_cats(){
        return $this->hasMany(ProductCat::class,'parent_id');
    }


    public  function scopeFilter(Builder $builder,$params){
        if(!empty($params['parent_id'])){
            $builder->where("parent_id",$params["parent_id"]);
        }else{
            $builder->where("parent_id",null);
        }
        if(!empty($params['title'])){
            $builder->where('title', 'like', '%' . $params["title"] . '%');
        }
        return $builder;
    }
}
