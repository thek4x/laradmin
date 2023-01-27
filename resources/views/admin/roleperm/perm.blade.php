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
                        <h4 class="float-start">Yönetim Paneli Permitasyonları</h4>                        
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>

                            <tr>
                                <th scope="col">ID</th>                                
                                <th scope="col">Username</th>                                
                                <th scope="col">Roles</th>                    
                                <th scope="col">Permission</th>
                                <th class="text-center" scope="col">Ayarlar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($all_admin as $admins)
                            @php 
                                $adminroles = $admins->roles->pluck('name')->toArray();
                                $adminroles = implode(', ',$adminroles);

                                $adminperms = $admins->permissions->pluck('name')->toArray();
                                $adminperms = implode(', ',$adminperms);
                            @endphp
                            <tr>
                                <td>{{ $admins->id }}</td>
                                <td>{{ $admins->username }}</td>
                                <td>{{ $adminroles }}</td>                                                        
                                <td>{{ $adminperms }}</td>                                                        
                                <td class="text-center">
                                    <div class="action-btns">                           
                                        <a href="{{ route('admin.permadd',$admins->id) }}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>



</div>
@endsection