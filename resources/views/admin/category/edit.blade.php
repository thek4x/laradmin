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
               
                </script>

@endpush
@section('content')
                <div class="row layout-top-spacing">
                    <div class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">                                
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Category Ekleme</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <form method='POST' action='{{ route('category.update',$category->id) }}'>
                                @csrf
                                    @method('PUT')
                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <select id="select-beast" placeholder="Üst Kategori..." autocomplete="off" name="category_id">
                                                <option value="">Üst Kategori</option>                                        
                                            </select>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Kategori Başlık" name='title' value="{{$category->title}}" />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Kategori Açıklama" name='description' value="{{$category->description}}" />
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Key - Slug Adı" value="{{$category->slug}}" name='slug'/>
                                        </div>
                                    </div>
                                    <div class="row mb-4">       
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="icon - html tag" value="{{$category->icon}}" name='icon'/>
                                        </div>    
                                        <div class="col">
                                        </div>
                                    </div>

                                    <input type="submit" name="time" class="btn btn-primary" value="Gönder">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection