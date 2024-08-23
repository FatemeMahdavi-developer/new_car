@extends('admin.base')

@section('head')

@endsection

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <livewire:productcat::admin.index/>
            </div>
        </div>
    </div>
</section>

<x-livewire-notification::toast />

@endsection

@section('footer')
<script src="{{asset("admin/assets/js/livewire-sortable.js")}}"></script>
<x-livewire-alert::scripts />
@endsection
