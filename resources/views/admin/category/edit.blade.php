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
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="main-tab" data-bs-toggle="tab" data-bs-target="#main" type="button" role="tab" aria-controls="home" aria-selected="true">Category Düzenle</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="formcreator-tab" data-bs-toggle="tab" data-bs-target="#formcreator" type="button" role="tab" aria-controls="profile" aria-selected="false">Form Creator</button>
                                    </li>                                
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
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
                                    <div class="tab-pane fade " id="formcreator" role="tabpanel" aria-labelledby="formcreator-tab">
                                    <form method='POST' action='{{route('form_pages.save')}}'>
                                    @if(count($page_forms)>0)
                                    @csrf
                                    <input type='hidden' name="form_page" value="category" />
                                    @include('admin.forms.page_forms')
                                    <div style='clear:both'></div>
                                    <div class='col-12'>
                                        <button class='btn btn-primary float-end'>GÖNDER</button>
                                    </div>
                                    @else
                                        <p class="lead text-center">Henüz burası için form oluşturulmamıştır</p>
                                    @endif
                                    </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection