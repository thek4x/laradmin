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
                                        <h4>Slider Ekleme</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <form method='POST' action='{{ route('slider.update',$slider->id) }}' enctype="multipart/form-data">
                                @csrf
                                    @method('PUT')
                                    <div class="row mb-4">
                                    <div class="col-6">
                                        <select id="select-beast" placeholder="Üst Kategori..." autocomplete="off" name="category_id">
                                            <option value="">kategori seç</option>
                                            @foreach($kategori as $k)
                                            <optgroup label='{{$k->title}}'> 
                                                <option value='{{$k->id}}' {{ $k->id==$slider->category_id?'selected':'' }}>{{$k->title}}</option>
                                                @foreach($k->children as $s)
                                                <option value='{{$s->id}}' {{ $s->id==$slider->category_id?'selected':'' }}>{{$s->title}}</option>
                                                @include('admin.category.subtest',['childs'=>$s])
                                            @endforeach
                                            </optgroup>
                                          @endforeach
                                        </select>   
                                        
                                        
                                    </div>
                                         <div class="col">
                                            <input type="text" class="form-control" placeholder="Title" name='title' value="{{ $slider->title }}"/>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Detay" name='caption' value="{{ $slider->caption }}"/>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Route - Link" name='route' value="{{ $slider->route }}"/>
                                        </div>
                                    </div>
                                    <div class="row mb-4">       
                                        <div class="col m-auto">
                                            <input type="file" class="form-control"  name='photo'  />
                                        </div>                                            
                                    </div>
                                   
                                    <input type="submit" name="time" class="btn btn-primary" value="Gönder">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection