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

@section('content')
            <div class="row layout-top-spacing">

                <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="float-start">E-Bülten Listesi</h4>                        
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class="table-responsive">
                                <table id="zero-config" class="table dt-table-hover h-100">
                                    <thead>

                                        <tr>
                                            <th scope="col">E-Posta</th>                                
                                            <th scope="col">Name</th>                                
                                            <th scope="col">Group</th>                    
                                            <th scope="col">İp</th>
                                            <th scope="col">Çalışıyor mu</th>
                                            <th scope="col">Kayıt Tarih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ebultens as $eb)
                                        <tr>
                                            <td>{{ $eb->eposta}}</td>
                                            <td>{{ $eb->name}}</td>
                                            <td>{{ $eb->group}}</td>
                                            <td>{{ $eb->ip}}</td>
                                            <td>{!! $eb->work==1?'<span class="badge badge-success">Aktif</span>':'<span class="badge badge-danger">Aktif Değil</span>' !!}</td>
                                            <td>{{ $eb->created_at }}</td>
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