@extends('admin.layouts.main')
@push('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/tomSelect/tom-select.default.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/tomSelect/custom-tomSelect.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/editors/markdown/simplemde.min.css') }}" />
            <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

@endpush

@push('custom-js')
                <script src="{{ asset('src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
                <script src="{{ asset('src/plugins/src/editors/markdown/simplemde.min.js') }}"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
                <script type='text/javascript'>

                        new TomSelect("#select-beast",{
                            create: true,
                            sortField: {
                                field: "text",
                                direction: "asc"
                            }
                        });
                        
    //                        new SimpleMDE({
    //                        element: document.getElementById("dataeditor"),
    //                        spellChecker: false,
    //                        autosave: {
    //                            enabled: true,
    //                            unique_id: "dataeditor",
    //                        },
    //                    });
    
            var csrf_token = $("meta[name=csrf-token").attr('content');
                var options = {
                 filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                 filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token='+csrf_token,
                 filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                 filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='+csrf_token
               };
                CKEDITOR.replace('my-editor', options);
                </script>

@endpush
@section('content')
                <div class="row layout-top-spacing">
                    <div class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">                                
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Sayfa Detaylar??</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <form method='POST' action='{{ route('info.store') }}'>
                            @csrf
                                    <div class="row mb-4">
                                        <div class="col-6 m-auto">
                                            <select id="select-beast" placeholder="Data tipini se??in" autocomplete="off" name='type'>
                                                <option value='info'>bilgi</option>
                                                <option value='form'>form</option>
                                                <option value='json'>json</option>
                                                <option value='html'>html</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Categori, Group Ad??, Form T??r?? " name='category'/>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Key - Slug Ad?? - Form Namei" name='key'/>
                                        </div>
                                    </div>
                                    <div class="row mb-4">       
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Title" name='title'/>
                                        </div>    
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Route - Url - Link" name='route'/>
                                        </div>
                                    </div>
                                    <div class="row mb-4">      
                                        <div class='col'>
                                            <textarea id="my-editor" name="data" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <input type="submit" name="time" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection