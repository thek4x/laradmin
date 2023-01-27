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
                                    <h4 class="float-start">Page Form Detayları</h4>          
                                    <a href="{{ route('form_pages.create') }}" class='btn btn-primary float-end mt-2'>Yeni Form +</a>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <div class="col-6 m-auto text-center">                                    
                                </div>

                                <table id="zero-config" class="table dt-table-hover h-100">
                                    <thead>

                                        <tr>
                                            <th scope="col">Page</th>                                
                                            <th scope="col">Form Label</th>                                
                                            <th scope="col">Form Name</th>                                                                
                                            <th scope="col">Form Type</th>                                                                
                                            <th scope="col">Tarih</th>
                                            <th class="text-center" scope="col">Ayarlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list as $result)
                                        @if(strpos($result->form_input, 'type="text"') > 0)
                                           @php $text = 'text'; @endphp
                                        @elseif(strpos($result->form_input, 'type="number"') > 0)
                                            @php $text = 'number'; @endphp
                                        @elseif(strpos($result->form_input, 'type="range"') > 0)
                                            @php $text = 'range'; @endphp
                                        @elseif(strpos($result->form_input, 'select') > 0)
                                            @php $text = 'select'; @endphp
                                        @elseif(strpos($result->form_input, 'radio') > 0)
                                            @php $text = 'radio'; @endphp
                                        @elseif(strpos($result->form_input, 'checkbox') > 0)
                                            @php $text = 'checkbox'; @endphp
                                        @elseif(strpos($result->form_input, 'textarea') > 0)
                                            @php $text = 'textarea'; @endphp
                                        @endif
                                        <tr>
                                            <td>{{$result->form_page}}</td>
                                            <td>{{$result->form_label}}</td>
                                            <td>{{$result->form_name}}</td>
                                            <td>{{$text}}</td>
                                            <td>{{$result->created_at}}</td>
                                            <td>
                                                <a href="{{ route('form_pages.edit',$result->id) }}" class="action-btn btn-edit bs-tooltip me-2 text-primary" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                                <a href="{{ route('form_pages.delete',$result->id) }}" class="action-btn btn-delete bs-tooltip text-danger" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
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