@extends('admin.layouts.main')
@push('custom-css')
<link rel='stylesheet' href='{{ asset('src/plugins/src/notification/snackbar/snackbar.min.css') }}' />
<link rel='stylesheet' href='{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}' />
<link rel='stylesheet' href='{{ asset('src/assets/css/light/components/modal.css') }}' />
<link rel='stylesheet' href='{{ asset('src/plugins/css/light/editors/quill/quill.snow.css') }}' />
<link rel='stylesheet' href='{{ asset('src/assets/css/light/apps/mailbox.css') }}' />
<link rel='stylesheet' href='{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}' />
<link rel='stylesheet' href='{{ asset('src/assets/css/dark/components/modal.css') }}' />
<link rel='stylesheet' href='{{ asset('src/plugins/css/dark/editors/quill/quill.snow.css') }}' />
<link rel='stylesheet' href='{{ asset('src/assets/css/dark/apps/mailbox.css') }}' />
<link rel='stylesheet' href='{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}' />
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/tomSelect/custom-tomSelect.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/tomSelect/tom-select.default.min.css') }}" />

    <style>
.mail-box-container{
min-height:500px;
}
</style>
@endpush
@push('custom-js')
    <script type='text/javascript' src='{{ asset('src/plugins/src/editors/quill/quill.js') }}'></script>
    <script type='text/javascript' src='{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('src/plugins/src/notification/snackbar/snackbar.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('src/assets/js/apps/mailbox.js') }}'></script>
    <script src="{{ asset('src/plugins/src/tomSelect/tom-select.base.js') }}"></script>

        
    <script type="text/javascript">
    $(function(){
        $("#btn-send").click(function(){
            form = $("#mailSend");
            ql_editor = $(".ql-editor").html();
            $.ajax({
                type:'POST',
                url:'{{ route('mail.store') }}',
                data:form.serialize()+'&content='+ql_editor,
                dataType:'json',
                success:function(response){
                    if(response.type=='success'){
                     toastr.success(response.message,response.title);
                    }else{
                        toastr.error(response.message,response.title)
                    }
                }
            });
        });
            
            
            
        $(".mail-item").click(function(){
        $item = $(this);
        $usermail  = $item.find('.user-email').text();
        $mailtitle = $item.find('.mail-title').text();
        $maildesc  = $item.find('.m-content').text();

        $("h5.modal-title").text($usermail);
        $("h5.m-title").text($mailtitle);
        $("p.modal-text").text($maildesc);
        });
            
            $("li.nav-item a").click(function(){    
                var groupSelect=$(this).attr("id"); 
                var $selected = $("."+groupSelect);
                $(".mailInbox").hide();
                $selected.fadeIn()
            });
            
    });
        
    </script>
@endpush
@section('content')
@inject('str','Illuminate\Support\Str')
<div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">
                    
                    <div class="row layout-top-spacing">
                        <div class="col-xl-12 col-lg-12 col-md-12">
    
                            <div class="row">
    
                                 <div class="mail-box-container">

                                        <div class="mail-overlay"></div>

                                        <div class="tab-title">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-12 text-center mail-btn-container">
                                                    <a id="btn-compose-mail" class="btn btn-block" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-12 mail-categories-container">
    
                                                    <div class="mail-sidebar-scroll">
                                                        <p class="group-section"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg> Groups</p>
                                                        <ul class="nav nav-pills d-block group-list" id="pills-tab2" role="tablist">
                                                            @foreach($grouped as $gr)
                                                            <li class="nav-item">                                                                
                                                                <a class="nav-link list-actions active g-dot-primary" id="{{$gr}}"><span>{{$gr}}</span></a>
                                                            </li>
                                                            @endforeach

                                                        </ul>
    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="mailbox-inbox" class="accordion mailbox-inbox">
    
                                            <div class="search">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                                                <input type="text" class="form-control input-search" placeholder="Search Here...">
                                            </div>
    
                                            <div class="action-center">
                                                <div class="">
                                                    <div class="form-check form-check-primary form-check-inline mt-1" data-bs-toggle="collapse" data-bs-target>
                                                        <input class="form-check-input inbox-chkbox" type="checkbox" id="inboxAll">
                                                    </div>
                                                </div>
    
                                                <div class="">
                                                </div>
                                            </div>
                                    
                                            <div class="message-box">
                                                
                                                <div class="message-box-scroll" id="ct">
                                                    @foreach($sended as $mails)
                                                    <div class="mail-item mailInbox {{$mails->group}}">
                                                        <div class="animated animatedFadeInUp fadeInUp" id="mailHeadingSeventeen">
                                                            <div class="mb-0">
                                                                <div class="mail-item-heading collapsed" >
                                                                    <div class="mail-item-inner">
    
                                                                        <div class="d-flex">
                                                                            <div class="form-check form-check-primary form-check-inline mt-1" data-bs-toggle="collapse" data-bs-target>
                                                                                <input class="form-check-input inbox-chkbox" type="checkbox">
                                                                            </div>
                                                                            <div class="f-head">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                                                                            </div>
                                                                            <div class="f-body" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
                                                                                <div class="meta-mail-time">
                                                                                    <p class="user-email">{{ $str::limit($mails->email,15) }}</p>
                                                                                </div>
                                                                                <div class="meta-title-tag">
                                                                                    <p class="mail-content-excerpt" ><span class="mail-title">{{ $str::limit($mails->subject,10) }} </span>{{ strip_tags($str::limit($mails->content,50)) }}</p>
                                                                                    <div class="hide m-content d-none">{!! $mails->content !!} </div>
                                                                                    <div class="tags">
                                                                                        <span class="g-dot-primary"></span>
                                                                                        <span class="g-dot-warning"></span>
                                                                                        <span class="g-dot-success"></span>
                                                                                        <span class="g-dot-danger"></span>
                                                                                    </div>
                                                                                    <p class="meta-time align-self-center">{{ $mails->updated_at->diffForHumans() }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                
                                                    

                                                    
    
    
                                                </div>
                                            </div>
    
    
                                        </div>
                                        
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="composeMailModal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title add-title" id="notesMailModalTitleeLabel">E-Posta Gönder</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-bs-dismiss="modal"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> -->
                                                    <div class="compose-box">
                                                        <div class="compose-content">
                                                            <form method='POST' action='{{ route('mail.store') }}' id='mailSend'>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="mb-4 mail-form">
                                                                            <p>Kime Gidecek:</p>
                                                                            <input type='text' class='form-control' name='email' />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-4 mail-cc">
                                                                            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg> E-Postayi Grupla:</p>
                                                                            <div>
                                                                                <select class="form-control groupedselect" placeholder="Group Ekle veya Seç" class="form-control" name="group">
                                                                                    <option value=""></option>
                                                                                    @foreach($grouped as $gr)
                                                                                    <option value='{{$gr}}'>{{$gr}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <span class="validation-text"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-4 mail-cc">
                                                                            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg> CC:</p>
                                                                            <div>
                                                                                <input type="text" id="m-cc" class="form-control" name='cc'>
                                                                                <span class="validation-text"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                       
    
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="btn-save" class="btn float-left btn-success"> Save</button>
                                                    <button id="btn-reply-save" class="btn float-left btn-success"> Save Reply</button>
                                                    <button id="btn-fwd-save" class="btn float-left btn-success"> Save Fwd</button>
    
                                                    <button class="btn" data-bs-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>
    
                                                    <button id="btn-reply" class="btn btn-primary"> Reply</button>
                                                    <button id="btn-fwd" class="btn btn-primary"> Forward</button>
                                                    <button id="btn-send" class="btn btn-primary"> Send</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
    
                        </div>
                    </div>

                </div>
@endsection
    
     <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body pt-0">
                        <h5 class="m-title mt-2"></h5>
                        <hr/>
                        <p class="modal-text">
                            

                        </p>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>