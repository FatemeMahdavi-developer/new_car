<?php

namespace Modules\ProductCat\Livewire\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\ProductCat\Models\ProductCat;
use Livewire\Attributes\On;
class Update extends Component
{
    use WithFileUploads;
    public $seo_url,$seo_title,$title,$pic,$path_pic,$parent_id='';

    public $module,$module_name='';
    public $product_cat;

    public function mount($productcat){
        $this->module='product_cat';
        $this->module_name='دسته بندی محصول';

        $this->product_cat=$productcat;

        $this->seo_url=$this->product_cat->seo_url;
        $this->seo_title=$this->product_cat->seo_title;
        $this->title=$this->product_cat->title;
        $this->pic=$this->product_cat->pic;
        $this->parent_id=$this->product_cat->parent_id;
    }

    public function updatingPic($value)
    {
        $this->pic=Storage::disk('public')->put('/'.$this->module,$value);
        $this->path_pic=$this->pic;

    }

    public function rules(){
        $rules=[
            'seo_url'=>['required','string',Rule::unique('product_cats','seo_url')->ignore($this->product_cat->id)],
            'seo_title'=>['nullable','string','min:3'],
            'title'=>['required','string','min:3','max:255'],
            'pic'=>['nullable','image','max:1024','mimes:jpg,jpeg,png,svg,webp,gif'],
            'parent_id'=>['nullable','integer']
        ];
       if(is_string($this->pic) &&  in_array(pathinfo($this->pic,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp'])){
            unset($rules['pic']);
       }
        return $rules;
    }

    protected function prepareForValidation($attribute){
        $attribute['seo_url']=sluggableCustomSlugMethod($this->seo_url);
        return $attribute;
    }

    public function update(){
        $inputs=$this->validate();
        if(empty($inputs['parent_id'])){
            $inputs['parent_id']=null;
        }
        if(!empty($inputs['pic'])){
            $inputs['pic']=$this->path_pic;
        }
        $this->product_cat->update($inputs);

        session()->flash('message','با موفقیت آپدیت شد');
        $this->reset();
        // return back()->with(['message'=>'با موفقیت آپدیت شد']);
    }

    public function updating($property, $value)
    {
        if($property=="parent_id"){
            $this->parent_id = $value;
        }
        // Handle the value change
    }
    public function render()
    {
        $product_cats=ProductCat::where('parent_id',null)->with('sub_cats')->get();
        return view('productcat::livewire.admin.update',compact('product_cats'));
    }
}
