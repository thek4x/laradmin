@extends('admin.layouts.main')
@push('custom-css')    
<link rel='stylesheet' href="{{ asset('layouts/semi-dark-menu/css/light/plugins.css')}}" />
<link rel='stylesheet' href="{{ asset('layouts/semi-dark-menu/css/dark/plugins.css')}}" />
<link rel='stylesheet' href="{{ asset('src/assets/css/light/components/tabs.css')}}" />
<link rel='stylesheet' href="{{ asset('src/assets/css/dark/components/tabs.css')}}" />
<link rel='stylesheet' href="{{ asset('src/plugins/src/filepond/filepond.min.css')}}" />
<link rel='stylesheet' href="{{ asset('src/plugins/src/filepond/FilePondPluginImagePreview.min.css')}}" />
<link rel='stylesheet' href="{{ asset('src/plugins/css/dark/filepond/custom-filepond.css')}}" />
<link rel='stylesheet' href="{{ asset('src/assets/css/dark/elements/alert.css')}}" />
<link rel='stylesheet' href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css')}}" />
<link rel='stylesheet' href="{{ asset('src/plugins/css/dark/notification/snackbar/custom-snackbar.css')}}" />
<link rel='stylesheet' href="{{ asset('src/assets/css/dark/forms/switches.css')}}" />
<link rel='stylesheet' href="{{ asset('src/assets/css/dark/components/list-group.css')}}" />
<link rel='stylesheet' href="{{ asset('src/assets/css/light/users/account-setting.css')}}" />
<link rel='stylesheet' href="{{ asset('src/assets/css/dark/users/account-setting.css')}}" />
@endpush
@push('custom-js')
    
    <script src="{{ asset('src/plugins/src/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('src/assets/js/users/account-settings.js') }}"></script>
@endpush



@section('content')
<div class="account-settings-container layout-top-spacing">
    
                        <div class="account-content">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h2>Yeni Adminuser Profil</h2>

                                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="animated-underline-home-tab" data-bs-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Profile</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
    
                            <div class="tab-content" id="animateLineContent-4">
                                <div class="tab-pane fade active show" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                            <form class="section general-info" method='POST' action='{{ route('adminusers.store') }}'>
                                                @csrf
                                                <div class="info">
                                                    <h6 class="">YENİ YÖNETİCİ EKLE</h6>
                                                    <div class="row">
                                                        <div class="col-lg-11 mx-auto">
                                                            <div class="row">
                                                          
                                                                <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                                    <div class="form">
                                                                        <div class="row">
                                                                           
            
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="fullName">Ad Soyad</label>
                                                                                    <input type="text" class="form-control mb-3" id="fullName" name='adsoyad' value=''>
                                                                                </div>
                                                                            </div>
             <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="fullName">username</label>
                                                                                    <input type="text" class="form-control mb-3" id="fullName" name='username' value=''>
                                                                                </div>
                                                                            </div>
                                                                          
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="email">Email</label>
                                                                                    <input type="text" class="form-control mb-3" id="email" name='email' value='' />
                                                                                </div>
                                                                            </div>                                    
                                                                            
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="email">Password</label>
                                                                                    <input type="password" class="form-control mb-3" id="password" name='password' value='' />
                                                                                </div>
                                                                            </div>                                    
                                                                            
                                                                            <div class="col-md-12 mt-1">
                                                                                <div class="form-group text-end">
                                                                                    <button class="btn btn-secondary _effect--ripple waves-effect waves-light">Save</button>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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