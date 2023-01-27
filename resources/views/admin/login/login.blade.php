<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>SignIn Boxed | CORK - Multipurpose Bootstrap Dashboard Template </title>
    <link rel="icon" type="image/x-icon" href="{{ asset(('/src/assets/img/favicon.ico')) }}"/>
    <link href="{{ asset(('layouts/semi-dark-menu/css/light/loader.css')) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset(('layouts/semi-dark-menu/css/dark/loader.css')) }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset(('layouts/semi-dark-menu/loader.js')) }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="//fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset(('src/bootstrap/css/bootstrap.min.css'))}}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset(('layouts/semi-dark-menu/css/light/plugins.css'))}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset(('src/assets/css/light/authentication/auth-boxed.css'))}}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset(('layouts/semi-dark-menu/css/dark/plugins.css')) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset(('src/assets/css/dark/authentication/auth-boxed.css')) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset(('css/toastr.css')) }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex bg-dark">

        <div class="container mx-auto align-self-center">
    
            <div class="row">
    
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body bg-white">
    
                            <div class="row">
                                <div class="col-md-12 mb-3 m-auto justify-content-center text-center">
                                   
                                    <h2>YÖNETİM PANELİ</h2>
                                    <p>Bu alana erişen tüm ip adresleri gözetim altındadır.</p>
                                    
                                </div>
                                <form method='POST' action='{{ route('admin.login.store')}}'>
                                    @csrf
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="username" class="form-control" name='username' />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="form-check form-check-primary form-check-inline">
                                            <input class="form-check-input me-3" type="checkbox" id="form-check-default">
                                            <label class="form-check-label" for="form-check-default">
                                                Beni Hatırla
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <button class="btn btn-secondary w-100" type="submit">SIGN IN</button>
                                    </div>
                                </div>
                               </form>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>

    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="//code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="{{ asset(('src/bootstrap/js/bootstrap.bundle.min.js')) }}"></script>
    <script src="{{ asset(('js/toastr.min.js')) }}"></script>
    <script src="{{ asset(('src/assets/js/custom.js')) }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script type='text/javascript'>
     @if(Session::has('message'))
        toastr.{{Session::get('type')}}("{{Session::get('message')}}","{{Session::get('title')}}");
    @endif
    
    </script>
</body>
</html>