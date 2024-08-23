<?php

namespace Modules\ProductCat\Models;

use App\Trait\DateConvert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ProductCat\Database\Factories\ProductCatFactory;

class ProductCat extends Model
{
    use HasFactory,DateConvert;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'seo_title',
        'seo_url',
        'pic',
        'parent_id',
        'state'
    ];

    protected static function newFactory(): ProductCatFactory
    {
        return ProductCatFactory::new();
    }

    public function sub_cats(){
        return $this->hasMany(ProductCat::class,'parent_id');
    }


    public  function ScopFilter(Builder $builder,$params){
        if(!empty($params['catid'])){
            $builder->where("catid",$params["catid"]);
        }else{
            $builder->where("catid",'0');
        }
        if(!empty($params['title'])){
            $builder->where('title', 'like', '%' . $params["title"] . '%');
        }
        return $builder;
    }
}
