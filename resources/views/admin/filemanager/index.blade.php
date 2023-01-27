@extends('admin.layouts.main')
@push('custom-css')
<style>
    iframe {
    width: 100%;
    height: 500px;
}
</style>
@endpush
@section('content')
<div class="row layout-top-spacing">

    <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
           
            <div class="widget-content widget-content-area">
                <iframe src="{{ url('laravel-filemanager') }}"></iframe>
            </div>
        </div>
    </div>

</div>

@endsection