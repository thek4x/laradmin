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
                                <form method='POST' action='{{ route('category.store') }}'>
                                @csrf
                                    <div class="row mb-4">
                                    <div class="col-6">
                                        <select id="select-beast" placeholder="??st Kategori..." autocomplete="off" name="category_id">
                                            @foreach($kategori as $k)
                                            <optgroup label='{{$k->title}}'> 
                                                <option value='{{$k->id}}'>{{$k->title}}</option>
                                                @foreach($k->children as $s)
                                                <option value='{{$s->id}}' {{$s->id==$k->id?'selected':''}}>{{$s->title}}</option>
                                                @include('admin.category.subtest',['childs'=>$s])
                                            @endforeach
                                            </optgroup>
                                          @endforeach
                                        </select>   
                                        
                                        
                                    </div>
                                         <div class="col">
                                            <input type="text" class="form-control" placeholder="Kategori Ba??l??k" name='title'/>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Kategori A????klama" name='description'/>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Key - Slug Ad??" name='slug'/>
                                        </div>
                                    </div>
                                    <div class="row mb-4">       
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="icon - html tag" name='icon'/>
                                        </div>    
                                        <div class="col">
                                        </div>
                                    </div>
                                   
                                    <input type="submit" name="time" class="btn btn-primary" value="G??nder">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection