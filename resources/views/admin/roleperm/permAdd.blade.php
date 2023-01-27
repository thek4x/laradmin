@extends('admin.layouts.main')
@push('custom-css')    
<style>
.each {
    border-bottom: solid 4px #0225c9ad;
    float: left;
    width: 100%;
    padding-bottom: 10px;
    padding-top: 10px;
    border-bottom-style: double;
}
</style>
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
                        <h4>Yönetici Yetkileri Düzenleme</h4>
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area pt-0">

                <div class="row">
                    <div class="col-lg-8 col-8 m-auto">
                        <form method="post" action="{{ route('admin.permUpdate',$admin->id) }}">
                            @csrf

                            <div class="col-lg-12 mt-2 m-auto float-start">
                                <div class="checkList">
                                    <label>Rol Listesi</label>
                                    <hr />
                                    <div class="d-block"></div>
                                    @foreach($all_role as $roles)
                                     @php 
                                        $admin_roles = $admin->roles->pluck('name')->toArray();
                                        $check = in_array($roles->name,$admin_roles)?'checked':'';
                                    @endphp                                     
                                    <div class="form-check form-check-success form-check-inline">
                                        <label class="form-check-label">{{$roles->name}}</label>
                                        <input class="form-check-input" {{ $check }} type="checkbox" value="{{ $roles->name}}" name="roles[]"  />
                                    </div>
                                    @endforeach
                                </div>
                                <hr />
                            </div>


                            <div class="col-lg-12 col-12 mt-3 m-auto float-start rplist">
                                <label>Permitasyon Listesi</label>
                                @php
                                    $grouped = $perms->groupBy('group_name');  
                                    $hasPerm = collect($getroleperm->toArray());                                    
//                                    echo in_array('role.delete',$hasPerm);
//                                    echo in_array($hasPerm,'role.list');
                                @endphp

                                @foreach($grouped as $label => $perm)
                                <div id="{{$label}}" class="d-block each">
                                    <div class="col-lg-3 col-3 float-start"><label><input type="checkbox" class="form-check-input roleCheck" value="{{ $label }}"> {{ $label}}</label></div>
                                    <div class="col-lg-9 col-9 float-start {{$label}}_parent permParent">
                                    @foreach($perm as $pm)        
                                        <div class="form-check form-check-success form-check-inline">
                                            <label class="form-check-label">{{ $pm->name }}</label>
                                            <input class="form-check-input permCheck" type="checkbox" value="{{ $pm->name }}" name="permission[]" @php echo $hasPerm->contains($pm->name)!=null?'checked':''; @endphp />
                                        </div>
                                    @endforeach                                    
                                    </div>
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