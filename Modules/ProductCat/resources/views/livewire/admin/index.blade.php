<div class="card">
    <div class="card-header">
        <h4>جدول ساده</h4>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#tab1" role="tab">لیست</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#tab2" role="tab">جستجو</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                <div class="table-responsive">
                    @if(isset($product_cats[0]))
                    <table class="table table-bordered table-md"  wire:sortable="updateTaskOrder">
                        <tbody>
                        <tr style="text-align: center">
                            <th><input type="checkbox" id="check_all" wire:click="check_all" wire:model="selectAll"></th>
                            <th>#</th>
                            <th>نام</th>
                            <th>ترتیب</th>
                            <th>تاریخ</th>
                            <th>وضعیت</th>
                            <th>عمل</th>
                        </tr>
                            @foreach ($product_cats as $product_cat)
                            <tr style="text-align: center" wire:sortable.item="{{ $product_cat->id }}" wire:key="task-{{ $product_cat->id }}">
                                <td><input type="checkbox" id="checkbox_item" value="{{$product_cat->id}}"  wire:model="items" ></td>
                                <td>{{$loop->index+1}}</td>
                                <td wire:sortable.handle>{{$product_cat->title}}</td>
                                <td>{{$product_cat->order}}</td>
                                <td>{{$product_cat->DateConvert()}}</td>
                                <td>
                                    <div class="pretty p-switch">
                                        <input type="checkbox" @if($product_cat->state) checked @endif  wire:click="change_state({{$product_cat->id}})" ><div class="state p-success"><label></label></div>
                                    </div>
                                </td>
                                <td>
                                    <a wire:navigate href="{{route("admin.productcat.edit",['productcat'=>$product_cat['id']])}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                    <button type="submit" wire:click="delete({{$product_cat->id}})" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></button>
                                    <a wire:navigate href="?catid={{$product_cat['id']}}" class="btn btn-primary btn-sm">زیر بخش :<span class="badge badge-transparent">{{$product_cat->sub_cats()->count()}}</span></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-danger">نتیجه ای یافت نشد</div>
                    @endif
                    {{$product_cats->links()}}
                </div>
            </div>
            <div class="tab-pane fade" id="tab2" role="tabpanel">
                <div class="form-group w-50">
                    <label for="title">نام</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group w-50">
                    <button type="submit" class="btn btn-primary mr-1">جستجو</button>
                </div>
            </div>
        </div>
    </div>
</div>
