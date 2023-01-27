@extends('admin.layouts.main')
@push('custom-css')    
<style>

.rekle{
    margin:10px !important;
}
</style>
@endpush

@push('custom-js')

@endpush

@section('content')
<div class="row layout-top-spacing">
    <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4 class="float-start">Yönetim Paneli Rolleri</h4>
                        <a class='btn btn-primary p-2 float-end rekle' href="{{route('admin.rolecreate')}}">Yeni Rol Ekle</a>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <div class="col-lg-12 col-12">
                    <div class="row">
                        @foreach($all_role as $role)
                        <div class="col-lg-4">
                            <div class="card style-4">
                                <div class="card-body pt-3">
                                    <div class="media mt-0 mb-3">
                                        <div class=""></div>
                                        <div class="media-body">
                                            <h4 class="media-heading mb-0 text-center">{{ $role->name }}</h4>
                                            <!--<p class="media-text">Project Manager</p>-->
                                        </div>
                                    </div>
                                    <p class="card-text mt-4 mb-0 ">
                                        @foreach($role->getAllPermissions() as $perms)
                                        <span class="badge badge-primary mb-1"> {{$perms->name}} </span>
                                        @endforeach
                                    </p>
                                </div>
                                <div class="card-footer pt-0 border-0 text-center">
                                    <a href="{{ route('admin.roledit',$role->id) }}" class="action-btn btn-edit bs-tooltip me-2 text-primary" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                    <a href="{{ route('admin.roledelete',$role->id) }}" class="action-btn btn-delete bs-tooltip text-danger" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                </div>
                            </div>
                        </div>
                     @endforeach
                    </div>
                </div>


<!--                <div class="table-responsive">         

                    <table class="table table-bordered">
                        <thead>

                            <tr>
                                <th scope="col">Role</th>                                
                                <th class="text-center" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($all_role as $role)
                            <tr>
                                <td>
                                    <p class="mb-0">{{ $role->name }}</p>                                    
                                </td>                                
                                <td class="text-center">
                                    <div class="action-btns">

                                        <a href="{{ route('admin.roledit',$role->id) }}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                        <a href="{{ route('admin.roledelete',$role->id) }}" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>-->


            </div>
        </div>
    </div>



</div>
@endsection