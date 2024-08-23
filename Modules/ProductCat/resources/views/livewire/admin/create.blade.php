@if(session()->has('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<form wire:submit="save" enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group">
            <label>آدرس سئو</label>
            <input type="text" class="form-control" wire:model.debounce.100ms="seo_url">
            @error('seo_url')<span class="text text-danger">{{$message}}</span> @enderror
        </div>
        <div class="form-group">
            <label>عنوان سئو</label>
            <input type="text" class="form-control" wire:model="seo_title">
        </div>
        <div class="form-group">
            <label>عنوان</label>
            <input type="text" class="form-control" wire:model="title">
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>
      <div class="section-title">تصویر</div>
        <div class="custom-file w-50">
            <input type="file" class="custom-file-input" wire:model="pic">
            <label class="custom-file-label" for="pic">انتخاب فایل</label>
        </div>
        @error('pic') <span class="error">{{ $message }}</span> @enderror
        @if($path_pic)
            <img src="{{asset("storage/".$path_pic)}}" width="100px">
        @endif
       <div class="form-group" wire:ignore>
            <label>دسته بندی</label>
            @component("components.select_recursive",['name'=>'parent_id','options'=>$product_cats,'label'=>'دسته بندی','first_option'=>'دسته بندی اصلی', 'sub_method'=>'sub_cats','id'=>'select2-dropdown'])@endcomponent
        </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-primary mr-1" type="submit">ارسال</button>
    </div>
</form>


