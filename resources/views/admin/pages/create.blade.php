@extends('admin.layouts.main')
@push('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/tomSelect/tom-select.default.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/tomSelect/custom-tomSelect.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/editors/markdown/simplemde.min.css') }}" />
            <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
                <style>
                    .ts-wrapper{
                    height:100% !important;
                    }
                </style>
@endpush

@push('custom-js')
                <script src="{{ asset('src/plugins/src/tomSelect/tom-select.base.js') }}"></script>
                <script src="{{ asset('src/plugins/src/editors/markdown/simplemde.min.js') }}"></script>
                <!--<script src="{{ asset('src/ckeditor/ckeditor.js') }}"></script>-->
                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

                <script type='text/javascript'>
                    new TomSelect('#custom_js',{
                            create: true,
                            render:{
                            option: function(data) {
                                    const div = document.createElement('div');
                                    div.className = 'd-flex align-items-center';

                                    const span = document.createElement('span');
                                    span.className = 'flex-grow-1';
                                    span.innerText = data.text;
                                    div.append(span);
                                    return div;
                            },
                            }
                    });
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
                                        <h4>Sayfa Detayları</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="simple-tab">

                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Yeni Sayfa</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Keywordsler</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pageform-tab" data-bs-toggle="pill" data-bs-target="#pageform" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Keywordsler</button>
                                        </li>

                                    </ul>
                                    <hr/>
                                    <div class="tabcontent">
                                        <form method="POST" action="{{ route('pages.store')}}">
                                        @csrf
                                            <div class="tabdiv active" id="pills-home">
                                                <div class="row mb-4">


                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <select id="custom_js" multiple placeholder="Sayfa Kategorisi Seç Yada Ekle" class="form-control" name="category">                                                                                                                
                                                            @foreach($categorys as $cat)
                                                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="Sayfa Başlık Title" name='title'/>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="Sayfa Key - Slug" name='slug'/>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">      
                                                    <div class='col'>
                                                        <textarea id="my-editor" name="content" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <input type="submit" name="time" class="btn btn-primary float-end">
                                            </div>
                                            <div class="tabdiv " id="pills-profile">
                                                <div class="row mb-4">


                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="Page Title" name='page_title'/>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="Page Desc" name='page_description'/>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="Page Keywords" name='page_keyword'/>
                                                    </div>
                                                    <div class="col">

                                                    </div>
                                                </div>

                                                <input type="submit" name="time" class="btn btn-primary float-end">

                                            </div>
                                        </form>
                                        <div class="tabdiv " id="pageform">
                                            <form method='POST' action='''>
                                                @csrf
                                                <input type='hidden' name="form_page" value="pages" />
                                           @include('admin.forms.page_forms')
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection