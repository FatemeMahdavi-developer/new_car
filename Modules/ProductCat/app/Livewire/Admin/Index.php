<?php

namespace Modules\ProductCat\Livewire\Admin;

use App\Base\groupAction;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use Modules\ProductCat\Models\ProductCat;
use Ramsey\Uuid\Type\Integer;

class Index extends groupAction
{
    use WithPagination,LivewireAlert;

    private $models=ProductCat::class;
    public $product_cat;

    //search, check_all in pagination , multi orders (change state , change order)

    public $items = [];
    public $selectAll = false;

    public function getListeners()
    {
        return [
            'confirmed'
        ];
    }
    public function delete_all(){
        foreach ($this->items as $value) {
            ProductCat::where('id',$value)->delete();
        }
    }
    public function check_all(){

        $this->items=$this->selectAll ? $this->data()->pluck('id')->toArray()  : [];
    }

    public function updateTaskOrder($tasks)
    {
        foreach ($tasks as $task) {
            ProductCat::whereId($task['value'])->update(['order' => $task['order']]);
        }
    }


    public function confirmed()
    {
        $this->product_cat->delete();
    }
    public function change_state(ProductCat $productCat){
        $state=$productCat->state ? '0' : '1';
        $productCat->update(['state'=>$state]);
    }

    public function delete(ProductCat $productCat){
    //     $this->alert('info','Example of notification with modal event', [
    //         'modal' => '#hideModal'
    //     ]
    // );
        $this->product_cat=$productCat;
        $this->confirm('می خواهید حذف کنید؟', [
            'confirmButtonText' => 'بله',
            'cancelButtonText' => 'خیر',
            'icon' => '',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function data(){
       return ProductCat::with('sub_cats')->filter(request()->all())->orderby('order','DESC')->paginate(10);
    }

    public function render()
    {
        return view('productcat::livewire.admin.index',['product_cats'=> $this->data()]);
    }
}
