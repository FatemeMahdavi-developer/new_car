<?php

namespace Modules\ProductCat\Livewire\Admin;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use Modules\ProductCat\Models\ProductCat;
use Ramsey\Uuid\Type\Integer;

class Index extends Component
{
    use WithPagination,LivewireAlert;

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

    public function check_all(){
        $this->items=$this->selectAll ? ProductCat::get('id')->pluck('id')->toArray(0)  : [];
    }

    public function updateTaskOrder($tasks)
    {
        foreach ($tasks as $task) {
            ProductCat::whereId($task['value'])->update(['order' => $task['order']]);
        }
    }

    // public function scopSearch(Builder $builder, Model $model): void
    // {
        // $builder->where('created_at', '<', now()->subYears(2000));
    // }


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

    public function render()
    {
        return view('productcat::livewire.admin.index',['product_cats'=> ProductCat::filter($request->all())->where('parent_id',null)->with('sub_cats')->orderby('order','DESC')->paginate(10)]);
    }
}
