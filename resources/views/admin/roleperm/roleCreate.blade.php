@extends('admin.layouts.main')
@push('custom-css')    

@endpush

@push('custom-js')

@endpush

@section('content')
<div class="row layout-top-spacing">
    <div id="basic" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Yeni Rol Ekle</h4>
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area pt-0">

                <div class="row">
                    <div class="col-lg-8 col-8 m-auto">
                        <form method="post" action="{{ route('admin.roleStore') }}">
                            @csrf
                            
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Rol Ekle</label>
                                    <input type="text" class="form-control" value="" name="role" />
                                </div>
                            </div>

                            <div class="col-lg-12 col-12 mt-3 m-auto float-start">
                                @php
                                    $grouped = $perms->groupBy('group_name');                                    
                                @endphp
                                
                                @foreach($grouped as $label => $perm)
                                <div class="col-lg-3 col-3 float-start"><label>{{ $label }} sayfası</label></div>
                                <div class="col-lg-9 col-9 float-start">
                                    @foreach($perm as $pm)                                    
                                    <div class="form-check form-check-success form-check-inline">
                                        <label class="form-check-label">{{ $pm->name }}</label>
                                        <input class="form-check-input" type="checkbox" value="{{ $pm->name }}" id="form-check-success" name="permission[]" value="{{ $pm->name }} }}" />
                                    </div>
                                    @endforeach                                    
                                </div>
                                @endforeach
                                
                                
                                
                                
                            </div>



                            <div class="col-lg-12 col-12 pt-3 text-right float-end">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary text-right float-end" value="Kaydet">
                                </div>
                            </div>


                        </form>
                    </div>                                        
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script type='text/javascript'>
 
</script>
@endpush