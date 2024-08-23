@if(session()->has('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@if(session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif
<form wire:submit="update" enctype="multipart/form-data">
    @method('put')
    <div class="card-body">
        <div class="form-group">
            <label>آدرس سئو</label>
            <input type="text" class="form-control" wire:model="seo_url">
            @error('seo_url')<span class="text text-danger">{{$message}}</span> @enderror
        </div>
        <div class="form-group">
            <label>عنوان سئو</label>
            <input type="text" class="form-control" wire:model="seo_title">
            @error('seo_title')<span class="text text-danger">{{$message}}</span>  @enderror
        </div>
        <div class="form-group">
            <label>عنوان</label>
            <input type="text" class="form-control" wire:model="title">
            @error('title') <span class="text text-danger">{{ $message }}</span> @enderror
        </div>
      <div class="section-title">تصویر</div>
        <div class="custom-file w-50">
            <input type="file" class="custom-file-input" wire:model="pic">
            <label class="custom-file-label" for="pic">انتخاب فایل</label>
        </div>
        @if($path_pic)
        <img src="{{asset("storage/".$path_pic)}}" width="60px">
        @elseif($pic)
        <img src="{{asset("storage/".$pic)}}" width="60px">
        @endif
        @error('pic')<br><span class="text text-danger">{{ $message }}</span> @enderror
       <div class="form-group" wire:ignore>
            <label>دسته بندی</label>
            @component("components.select_recursive",['name'=>'parent_id','options'=>$product_cats,'label'=>'دسته بندی','first_option'=>'دسته بندی اصلی', 'sub_method'=>'sub_cats','id'=>'select2-dropdown','value'=>$parent_id])@endcomponent
        </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-primary mr-1" type="submit">ارسال</button>
    </div>
</form>


