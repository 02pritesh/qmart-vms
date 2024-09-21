<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
      <li class="nav-item">
          <!--<a class="nav-link" href="{{url('vendor-detail')}}">-->
              <a class="nav-link" href="{{url('dashboard')}}">
              
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title">Dashboard</span>
          </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{url('vendor-registration-detail')}}">
            <i class="typcn typcn-document-text menu-icon"></i>
            <span class="menu-title">Vendor Registration</span>
            {{-- <div class="badge badge-danger">new</div> --}}
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="" href="{{url('registration-detail')}}" aria-expanded="false"
            aria-controls="ui-basic">
            <i class="typcn typcn-document-text menu-icon"></i>
            <span class="menu-title">SKU Registration</span>
            {{-- <i class="menu-arrow"></i> --}}
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="" href="{{url('request-report-detail')}}" aria-expanded="false"
            aria-controls="form-elements">
            <i class="fa-regular fa-message mr-3"></i>
            <span class="menu-title">Reconciliations</span>
            {{-- <i class="menu-arrow"></i> --}}
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link" data-toggle="" href="{{url('innvoice-mrn-detail')}}" aria-expanded="false"
            aria-controls="form-elements">
            <i class="fa-regular fa-message mr-3"></i>
            <span class="menu-title">Innvoices & MRN</span>
            {{-- <i class="menu-arrow"></i> --}}
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link" data-toggle="" href="{{url('debit-credit-detail')}}" aria-expanded="false"
            aria-controls="form-elements">
            <i class="fa-solid fa-credit-card menu-icon"></i>
            <span class="menu-title">Debit/Credit Note</span>
            {{-- <i class="menu-arrow"></i> --}}
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link" data-toggle="" href="{{url('payment-follow-detail')}}" aria-expanded="false"
            aria-controls="form-elements">
            <i class="fa-solid fa-money-check menu-icon"></i>
            <span class="menu-title">Payment Follow-Up</span>
            {{-- <i class="menu-arrow"></i> --}}
        </a>
      </li>
     

{{-- 
      <li class="nav-item">
        <a class="nav-link" href="">
            <i class="typcn typcn-device-desktop menu-icon"></i>
            <span class="menu-title">Vendor Registration</span>
        </a>
      </li> --}}

    
   
      

      <li class="nav-item">
        {{-- <a class="nav-link" data-toggle="" aria-expanded="false"
            aria-controls="form-elements">
            <i class="fa-solid fa-clipboard-check mr-4"></i>
            <span class="menu-title">Submission</span>
            <i class="menu-arrow"></i>
        </a> --}}
        {{-- <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link"
                        href="../../pages/forms/basic_elements.html">Basic Elements</a></li>
            </ul>
        </div> --}}
    </li>
      {{-- <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false"
              aria-controls="charts">
              <i class="typcn typcn-chart-pie-outline menu-icon"></i>
              <span class="menu-title">Charts</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link"
                          href="../../pages/charts/chartjs.html">ChartJs</a></li>
              </ul>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false"
              aria-controls="tables">
              <i class="typcn typcn-th-small-outline menu-icon"></i>
              <span class="menu-title">Tables</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link"
                          href="../../pages/tables/basic-table.html">Basic table</a></li>
              </ul>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false"
              aria-controls="icons">
              <i class="typcn typcn-compass menu-icon"></i>
              <span class="menu-title">Icons</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../../pages/icons/mdi.html">Mdi
                          icons</a></li>
              </ul>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false"
              aria-controls="auth">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/login.html">
                          Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/register.html">
                          Register </a></li>
              </ul>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false"
              aria-controls="error">
              <i class="typcn typcn-globe-outline menu-icon"></i>
              <span class="menu-title">Error pages</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="error">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-404.html">
                          404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-500.html">
                          500 </a></li>
              </ul>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link"
              href="https://bootstrapdash.com/demo/polluxui-free/docs/documentation.html">
              <i class="typcn typcn-mortar-board menu-icon"></i>
              <span class="menu-title">Documentation</span>
          </a>
      </li> --}}
  </ul>
</nav>