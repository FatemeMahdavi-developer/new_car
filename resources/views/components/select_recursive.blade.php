@props(['options'=>[],'label'=>'','class'=>'w-50','name'=>'','first_option'=>false, 'sub_method' => '','value'=>'','id'=>false,'ignore_id'=>0,'choose'=>false])
<select class="form-control select2" id="{{$id}}">
    @if($first_option)
        <option value="0">{{$first_option}}</option>
    @endif
    @if($choose)
        <option value="">انتخاب کنید</option>
    @endif
    @if(isset($options[0]))
        @foreach($options as $option)
            @if($ignore_id)
                @if($option['id'] != $ignore_id)
                    <option value="{{$option["id"]}}" @if($option['id'] == $value) selected @endif>{{$option["title"]}}</option>
                    @component("components.sub_option",['options'=>$option, 'method'=>$sub_method,'value'=>$value])@endcomponent
                @endif
            @else
                <option value="{{$option["id"]}}" @if($option['id'] == $value) selected @endif>{{$option["title"]}}</option>
                @component("components.sub_option",['options'=>$option,'method'=>$sub_method,'value'=>$value])@endcomponent
            @endif
        @endforeach
    @endif
</select>

@section('footer')
<script>
   $(document).ready(function () {
        $("#"+"{{$id}}").select2();
        $("#"+"{{$id}}").on('change', function (e) {
            var data = $("#"+"{{$id}}").select2("val");
            @this.set("{{$name}}", data);
        });
    });
</script>
@endsection
