<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{url('admin/dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Customer</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">


          <li>
            <a href="{{url('admin/customer/add')}}">
              <i class="bi bi-circle"></i><span>Add Customer</span>
            </a>
          </li>
          <li>
            <a href="{{url('customer/show')}}">
              <i class="bi bi-circle"></i><span>Manage Customer</span>
            </a>
          </li>

        </ul>
      </li><!-- End Components Nav -->


      <li class="nav-item">
        <a class="nav-link @if (Request::segment(2) != 'category') collapsed @endif"data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Couses><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/courses/create') }}">
              <i class="bi bi-circle"></i><span> Add Couses </span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/category/show') }}">
              <i class="bi bi-circle"></i><span> Manage Couses</span>
            </a>
          </li>

        </ul>
      </li><!-- End Category Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Brand</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('admin/brand/add') }}">
              <i class="bi bi-circle"></i><span>Add Brand</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/brand/show') }}">
              <i class="bi bi-circle"></i><span>Manage Brand</span>
            </a>
          </li>

        </ul>
      </li><!-- End Tables Nav -->



       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{url('admin/product/add') }}">
              <i class="bi bi-circle"></i><span>Add Product</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin/product/show') }}">
              <i class="bi bi-circle"></i><span>Manage Product</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->










      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Sales</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <a href="{{url('/sale')}}">
              <i class="bi bi-circle"></i><span>Add sales</span>
            </a>
          </li>
          <li>
            <a href="{{url('/sale/show')}}">
              <i class="bi bi-circle"></i><span>Sale List</span>
            </a>
          </li>

        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/backup') }}">
          <i class="bi bi-person"></i>
          <span>Backup</span>
        </a>
      </li><!-- End Profile Page Nav -->





      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->



    </ul>
 </aside><!-- End Sidebar-->
