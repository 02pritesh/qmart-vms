<style>
  
    a{
      color:white;
      padding:10px;
      cursor:pointer;
      text-decoration:none; 
      font-size: 14px;
      border-radius:7px;
      text-align: center;
    }
    #new_register{
        background-color: rgb(19, 136, 58);
    }
    #new_sku{
        background-color: rgb(45, 93, 207); 
    }
    #request{
      background-color: rgb(42, 86, 75);
    }
    #innvoice{
      background-color: rgb(51, 123, 139);
    }
    #debit_credit{
      background-color: rgb(153, 58, 44);
    }
    #payment{
      background-color: rgb(69, 110, 225);
    }
    #new_register:hover,#new_sku:hover,#request:hover,#innvoice:hover,#debit_credit:hover,#payment:hover{
        text-decoration: none;
        color: white
    }
  
  </style>

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex justify-content-center">
      <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
        <!--<a class="navbar-brand brand-logo" href="https://www.qmart.in/wishlist.php" target="_blank"><img src="{{asset('public/assets/upload/header-logo.png')}}" alt="logo" style="width: 50px"></a>-->
        <!--<a class="navbar-brand brand-logo-mini" href="https://www.qmart.in/wishlist.php" target="_blank"><img src="{{asset('public/assets/upload/header-logo.png')}}" alt="logo" ></a>-->
        <h3 style="color:white; font-size:22px;" class="mt-2">VMS&nbsp;</h3>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button"
              data-toggle="minimize">
              <span class="typcn typcn-th-menu"></span>
          </button>
      </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    
@php
    use Illuminate\Support\Str;

    $pageTitle = '';
    $currentPath = Request::path();

    if (Request::is('vendor-detail')) {
        $pageTitle = 'Vendor Login Registration';
    } elseif (Request::is('dashboard')) {
        $pageTitle = 'Dashboard';
    } elseif (Request::is('vendor-registration-detail')) {
        $pageTitle = 'Vendor Registration';
    } elseif (Request::is('registration-detail')) {
        $pageTitle = 'Sku Registration';
    } elseif (Request::is('request-report-detail')) {
        $pageTitle = 'Request/Report';
    } elseif (Request::is('invoice-mrn-detail')) {
        $pageTitle = 'Invoices/MRN';
    } elseif (Request::is('innvoice-message')) {
        $pageTitle = 'Invoices/MRN';
    } elseif (Request::is('debit-credit-detail')) {
        $pageTitle = 'Debit/Credit Note';
    } elseif (Request::is('debit-credit-message')) {
        $pageTitle = 'Debit/Credit Note';
    } elseif (Request::is('payment-follow-detail')) {
        $pageTitle = 'Payment Follow-Up';
    } elseif (Request::is('payment-follow-message')) {
        $pageTitle = 'Payment Follow-Up';
    } elseif (Request::is('vendor-show-message*')) {
        $pageTitle = 'Vendor Message';
    } elseif (Request::is('innvoice-mrn-detail')) {
        $pageTitle = 'Invoices/MRN';
    }elseif (Request::is('edit-vendor-detail*')) {
        $pageTitle = 'Edit Vendor Profile';
    } elseif (Request::is('add-sub-admin')) {
        $pageTitle = 'Add Sub-Admin';
    } elseif (Str::is('edit-vendor-registration-detail*', $currentPath)) {
        $pageTitle = 'Edit Vendor Registration';
    }elseif (Str::is('edit-request-report*', $currentPath)) {
        $pageTitle = 'Request/Report';
    }elseif (Str::is('edit-sku-registration-detail*', $currentPath)) {
        $pageTitle = 'Edit Sku Registration';
    }elseif (Str::is('admin-reply*', $currentPath)) {
        $pageTitle = 'Request/Report';
    }elseif (Str::is('edit-innvoice-message*', $currentPath)) {
        $pageTitle = 'Invoices/MRN';
    }elseif (Str::is('edit-debit-credit-message*', $currentPath)) {
        $pageTitle = 'Debit/Credit Note';
    }elseif (Str::is('edit-payment-follow-message*', $currentPath)) {
        $pageTitle = 'Payment Follow-Up';
    }
@endphp

@if($pageTitle)
    <h5 style="color: #f38f21">{{ $pageTitle }}</h5>
@endif

   
    <div class="col-9 mt-1 mr-3">
        <div class="button d-flex justify-content-end gap-3">
          <a href="{{url('innvoice-message')}}" id="innvoice">New Invoice/MRN</a>
          <a href="{{url('debit-credit-message')}}" id="debit_credit">New Debit/Credit Note</a>
          <a href="{{url('payment-follow-message')}}" id="payment">New Payment Follow-up</a>
        </div>
    </div>

      <ul class="navbar-nav navbar-nav-right">
          {{-- <li class="nav-item nav-date dropdown">
              <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
                  <h6 class="date mb-0">Today : Mar 23</h6>
                  <i class="typcn typcn-calendar"></i>
              </a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                  id="messageDropdown" href="#" data-toggle="dropdown">
                  <i class="typcn typcn-cog-outline mx-0"></i>
                  <span class="count"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                  aria-labelledby="messageDropdown">
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                  <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                          <img src="../../images/faces/face4.jpg" alt="image" class="profile-pic">
                      </div>
                      <div class="preview-item-content flex-grow">
                          <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                          </h6>
                          <p class="font-weight-light small-text text-muted mb-0">
                              The meeting is cancelled
                          </p>
                      </div>
                  </a>
                  <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                          <img src="../../images/faces/face2.jpg" alt="image" class="profile-pic">
                      </div>
                      <div class="preview-item-content flex-grow">
                          <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                          </h6>
                          <p class="font-weight-light small-text text-muted mb-0">
                              New product launch
                          </p>
                      </div>
                  </a>
                  <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                          <img src="../../images/faces/face3.jpg" alt="image" class="profile-pic">
                      </div>
                      <div class="preview-item-content flex-grow">
                          <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                          </h6>
                          <p class="font-weight-light small-text text-muted mb-0">
                              Upcoming board meeting
                          </p>
                      </div>
                  </a>
              </div>
          </li>
          <li class="nav-item dropdown mr-0">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                  id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="typcn typcn-bell mx-0"></i>
                  <span class="count"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                  aria-labelledby="notificationDropdown">
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                  <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                          <div class="preview-icon bg-success">
                              <i class="typcn typcn-info mx-0"></i>
                          </div>
                      </div>
                      <div class="preview-item-content">
                          <h6 class="preview-subject font-weight-normal">Application Error</h6>
                          <p class="font-weight-light small-text mb-0 text-muted">
                              Just now
                          </p>
                      </div>
                  </a>
                  <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                          <div class="preview-icon bg-warning">
                              <i class="typcn typcn-cog-outline mx-0"></i>
                          </div>
                      </div>
                      <div class="preview-item-content">
                          <h6 class="preview-subject font-weight-normal">Settings</h6>
                          <p class="font-weight-light small-text mb-0 text-muted">
                              Private message
                          </p>
                      </div>
                  </a>
                  <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                          <div class="preview-icon bg-info">
                              <i class="typcn typcn-user mx-0"></i>
                          </div>
                      </div>
                      <div class="preview-item-content">
                          <h6 class="preview-subject font-weight-normal">New user registration</h6>
                          <p class="font-weight-light small-text mb-0 text-muted">
                              2 days ago
                          </p>
                      </div>
                  </a>
              </div>
          </li> --}}




          
          
   
         




          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-profile dropdown">
                


               
                <a class="nav-link mb-4" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="{{asset('public/assets/upload/header-logo.png')}}" alt="profile" / style="width:55px; height:55px;">
                   
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                    aria-labelledby="profileDropdown">
                    <!--<a class="dropdown-item">-->
                    <!--  <i class="fa-regular fa-user"></i>-->
                    <!--    Profile-->
                    <!--</a>-->
                      @if(session()->get('adminloginId') == 1)
                        <a class="dropdown-item" href="{{url('add-sub-admin')}}">
                              <i class="fa-regular fa-user"></i>
                            Add Sub Admin
                        </a>
                      @endif
                    <a class="dropdown-item" href="{{url('vendor-detail')}}">
                        <i class="fa-solid fa-circle-info"></i>
                        Vendor list
                    </a>
                
                    <a class="dropdown-item" href="{{url('admin-logout')}}">
                        <i class="typcn typcn-eject text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="typcn typcn-th-menu"></span>
      </button>
  </div>
</nav>