@extends('admin.layouts.main')
@push('custom-css')    
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
<style>
table#zero-config td {
    white-space: normal !important;
}
.rekle{
    margin:10px !important;
}
</style>

@endpush

@push('custom-js')
<script src="{{ asset('src/plugins/src/table/datatable/datatables.js') }}"></script>
<script>
$('#zero-config').DataTable({
    "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
"<'table-responsive'tr>" +
"<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
    "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": "Showing page _PAGE_ of _PAGES_",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Search...",
       "sLengthMenu": "Results :  _MENU_",
    },
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10 
});
</script>
@endpush
@inject('str','Illuminate\Support\Str')
@section('content')
<div class="row layout-top-spacing">

    <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4 class="float-start">Sliderlar</h4>          
                        <a href="{{ route('slider.create') }}" class='btn btn-primary float-end mt-2'> Yeni Slider + </a>                        
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
               
                <div class="table-responsive">
                        <table id="zero-config" class="table dt-table-hover h-100">
                        <thead>

                            <tr>
                                <th scope="col">Photo</th>                                
                                <th scope="col">Title</th>                                
                                <th scope="col">Caption</th>                                
                                <th scope="col">Category</th>                    
                                <th scope="col">Route</th>                    
                                <th class="text-center" scope="col">Ayarlar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $result)
                             @php $photo = asset(('uploads/slider/'.$result->photo)); @endphp
                            <tr>
                                <td><a href="{{ $photo }}"><img src='{{ $photo }}' class='' height='75' target='_blank' /></a></td>
                                <td>{{$str::limit($result->title,20)}}</td>                                                                
                                <td>{{$str::limit($result->caption,20)}}</td>                                                                
                                <td>@if(!empty($result->category->title)){{$result->category->title}}@endif</td>
                                <td>{{$result->route}}</td>                                
                                <td>
                                    <a href="{{ route('slider.edit',$result->id) }}" class="action-btn btn-edit bs-tooltip me-2 text-primary" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                    <a href="{{ route('slider.delete',$result->id) }}" class="action-btn btn-delete bs-tooltip text-danger" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>



</div>
@endsection