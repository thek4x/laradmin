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
                        <h4>Rol Düzenleme</h4>
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area pt-0">

                <div class="row">
                    <div class="col-lg-8 col-8 m-auto">
                        <form method="post" action="{{ route('admin.roleupdate',$role->id) }}">
                            @csrf
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Rolu Düzenle</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ $role->name }}" name="role" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 mt-3 m-auto float-start">
                                @php
                                    $grouped = $perms->groupBy('group_name');  
                                    $hasPerm = collect($getroleperm->toArray());                                    
//                                    echo in_array('role.delete',$hasPerm);
//                                    echo in_array($hasPerm,'role.list');
                                @endphp

                                @foreach($grouped as $label => $perm)
                                <div class="col-lg-3 col-3 float-start"><label>{{ $label }} sayfası</label></div>
                                <div class="col-lg-9 col-9 float-start">
                                    @foreach($perm as $pm)        
                                    <div class="form-check form-check-success form-check-inline">
                                        <label class="form-check-label">{{ $pm->name }}</label>
                                        <input class="form-check-input" type="checkbox" value="{{ $pm->name }}" name="permission[]" @php echo $hasPerm->contains($pm->name)!=null?'checked':''; @endphp />
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