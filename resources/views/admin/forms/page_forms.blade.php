@inject('str','Illuminate\Support\Str')
@foreach($page_forms as $key => $result)
@php $key++ @endphp

@php $col = isset($result->form_column) ? 'col-'.$result->form_column : ''; @endphp
<div class="col {{$col}} d-block float-start p-3">
    <label class="input-group-text">{{$result->form_label}}</label>
    @php
    $new_input= '';
    
    $form_input = $result->form_input;
    $new_input  = str_replace(['/>','">'],['data-value="'.$result->form_inputvalue.'" />','data-value="'.$result->form_inputvalue.'" ">'],$form_input);
    @endphp
    {!!$new_input!!}
</div>
@endforeach