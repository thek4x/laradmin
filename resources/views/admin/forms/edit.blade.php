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
                                        <h4>Sayfa Detaylarına Bilgi Düzenleme</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <form method='POST' action='{{ route('form_pages.update',$get_forms->id) }}'>
                            @csrf                        
                                    @method('PUT')
                                    <div class="row mb-4">
                                        <div class="col">
                                            <select class="form-control" placeholder="Hangi Sayfaya Eklenecek?" autocomplete="off" name='form_page'>
                                               @foreach($group_name as $gn)
                                                <option value="{{$gn->group_name}}" {{ $gn->group_name==$get_forms->form_page ? 'selected' : '' }}>{{$gn->group_name}}</option>
                                               @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <input type="range" class="form-control" placeholder="Formu Kapsayan Column Alanı" name='form_column' value='{{$get_forms->form_column}}' max='12' />
                                                <div class="mt-1">
                                                    <span class="badge badge-primary w-100">
                                                        <small id="helpertext" class="form-text mt-0 text-left"></small>
                                                    </span>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">       
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Label Başlık" name='form_label' value='{{$get_forms->form_label}}'/>
                                        </div>    
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Form Name" name='form_name' value='{{$get_forms->form_name}}'/>
                                        </div>    

                                    </div>
                                    @inject('str','Illuminate\Support\Str')
                                    @php
                                        $text= $str::contains($get_forms->form_input,'type="text"');
                                        $number= $str::contains($get_forms->form_input,'number');
                                        $range= $str::contains($get_forms->form_input,'range');
                                        $select= $str::contains($get_forms->form_input,'select');
                                        $radio= $str::contains($get_forms->form_input,'radio');
                                        $checkbox= $str::contains($get_forms->form_input,'checkbox');
                                        $textarea= $str::contains($get_forms->form_input,'textarea');
                                    @endphp
                                    <div class="row mb-4">      
                                        <div class="col">
                                            <select id="formCreate" class="form-control">
                                                <option value="text" {{$text==1?'selected':''}} >text</option>
                                                <option value="number" {{$number==1?'selected':''}}>number</option>
                                                <option value="range" {{$range==1?'selected':''}}>range</option>
                                                <option value="select" {{$select==1?'selected':''}}>select</option>
                                                <option value="radio" {{$radio==1?'selected':''}}>radio</option>
                                                <option value="checkbox" {{$checkbox==1?'selected':''}}>checkbox</option>
                                                <option value="textarea" {{$textarea==1?'selected':''}}>textarea</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="neweleman" class="form-control" id="newelement" value="{{$get_forms->form_input}}" />
                                        </div>
                                    </div>
                                    <div id="creatingFormDiv" class="row mb-2">


                                    </div>
                                    <div class="row" id="newcarea">
                                        <div id="workarea" class="col">


                                        </div>


                                    </div>


                                    <input type="submit" name="time" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection


@push('custom-js')
                <script type='text/javascript'>
                    $(function(){
                        function onlyLettersAndSpaces(str) {
                        return /^[A-Za-z\s]*$/.test(str);
                        }
                            $("input[type=range]").change(function(){
                                $("#helpertext").text($(this).val())
                            });
                        $form_type=$("#formCreate");
                        $creating_form = $("#creatingFormDiv");
                        $form_label = $("input[name=form_label]");
                        $newcarea=$("#newcarea");                        
                            
                            $form_type.change(function(){
                                $form_select = $(this).val();
                                if($form_select=='select' || $form_select=='checkbox' || $form_select=='radio'){
                                    $creating_form.find('.col').fadeIn();
                                    toastr.info("Lütfen kutucuğa seçenekleri virgülle ayırarak yazınız");
                                }else{
                                    $creating_form.find('.col').hide();
                                }
                            });
                                
                            $(".cForm").click(function(){
                                //yeni oluşturulacak input içi çalışma alanı
                                $workarea = $('#workarea');                                
                                //eleman yarat
                                var $eleman = '';
                                //elemana name vermek zorundasın
                                var $name = $.trim($("input[name=form_name]").val());
                                if($name==''){    
                                    toastr.error("Name Alanını Doldurmak Zorunludur !");
                                    return false;
                                }else{
                                //elemana name verilmişse devam et 
                                var $attr = $("input[name=form_attr]");
                                var $prop = 'name="'+$name+'" '+$attr.val()+'';           
                                //gelen eleman tipine göre elemanı kur
                                switch($form_type.val()){
                                    case 'text':
                                        $eleman = '<input type="text" '+$prop+' />';
                                        $element = $($eleman).addClass('form-control');

                                    break;        

                                    case 'number':
                                        $eleman = '<input type="number" '+$prop+' />';
                                        $element = $($eleman).addClass('form-control');

                                    break;        

                                    case 'range':
                                        $eleman = '<input type="range" '+$prop+' />';
                                        $element = $($eleman).addClass('form-control');

                                    break;    
                                    
                                    case 'select':
                                        $optionText= '';
                                        $options = $("#input-tags").val().split(',');
                                        $options.forEach(function($values){
                                            $optionText+='<option value="'+$values+'">'+$values+'</option>';
                                        });
                                        $eleman = '<select '+$prop+'>'+$optionText+'</select>';
                                        $element = $($eleman).addClass('form-control');

                                    break;
                                    
                                    case 'radio':
                                        $optionText= '';
                                        $options = $("#input-tags").val().split(',');
                                        $options.forEach(function($values){
                                            $optionText+='<input type="radio" '+$prop+' value="'+$values+'"> '+$values+'';
                                        });
                                        $eleman = $optionText;
                                        $element = $($eleman).addClass('form-check-input');
                                    break;
                                    case 'checkbox':
                                        $optionText= '';
                                        $options = $("#input-tags").val().split(',');
                                        $options.forEach(function($values){
                                            $optionText+='<input type="checkbox" '+$prop+' value="'+$values+'"> '+$values+'';
                                        });
                                        $eleman = $optionText;
                                        $element = $($eleman).addClass('form-check-input');
                                    break;
                                }
                                    $newcarea.fadeIn();
                                    
                                    $workarea.html($element);
                                    $("#newelement").val($eleman);
                             }       
                                
                        });
                                
                    });
                </script>
@endpush