@extends('admin.base')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>فرم پیشفرض</h4>
                    </div>
                    <livewire:productcat::admin.create />
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
