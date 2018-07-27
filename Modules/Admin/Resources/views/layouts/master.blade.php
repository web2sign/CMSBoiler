<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('page_title')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  @yield('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" />
  <link rel="stylesheet" href="{{url('media/css/bootstrap.min.css')}}" />
  <link rel="stylesheet" href="{{url('media/sweetalert/sweetalert.css')}}" />
  <link rel="stylesheet" href="{{url('media/css/AdminLTE.min.css')}}" />
  <link rel="stylesheet" href="{{url('media/css/skins/_all-skins.min.css')}}" />
  <link rel="stylesheet" href="{{url('media/css/styles.css')}}" />
  <script type="text/javascript">
    var site_url = "{{ url('/') }}";
  </script>
  <!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body class="@yield('body_class')">


<div class="wrapper">

  <header class="main-header">
    <a href="{{ url('admin') }}" class="logo">
      <span class="logo-mini"><b>C</b>B</span>
      <span class="logo-lg"><b>CMS</b>Boiler</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <li class="dropdown messages-menu">
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        
                        <img src="{{ url('media/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                      </div>
                      
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  
                </ul>
                
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          

          
          <li class="dropdown notifications-menu">
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          
          <li class="dropdown tasks-menu">
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      
                      <div class="progress xs">
                        
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          
          <li class="dropdown user user-menu">
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              
              <img src="{{ url('media/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
              
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              
              <li class="user-header">
                <img src="{{ url('media/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                
              </li>
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  <aside class="main-sidebar">

    
    <section class="sidebar">

      
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ url('media/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      

      
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        
        <li{!! (Request::is('admin/dashboard') ? ' class="active"' : '') !!}><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li{!! (Request::is('admin/media/files') ? ' class="active"' : '') !!}><a href="{{ url('admin/media/files') }}"><i class="fa fa-file"></i> <span>Media Library</span></a></li>
        <li class="treeview {!! (Request::is('admin/pages') || Request::is('admin/pages/*')  || Request::is('admin/page/*') ? ' active' : '') !!}">
          <a href="#"><i class="fa fa-book"></i> <span>Manage Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li{!! (Request::is('admin/pages') || Request::is('admin/pages/*') ? ' class="active"' : '') !!}><a href="{{ url('admin/pages') }}"><i class="fa fa-circle-o"></i> View Pages</a></li>
            <li{!! (Request::is('admin/page/create') ? ' class="active"' : '') !!}><a href="{{ url('admin/page/create') }}"><i class="fa fa-circle-o"></i> Create Page</a></li>
          </ul>
        </li>
        <li class="treeview {!! (Request::is('admin/users') || Request::is('admin/users/*')  || Request::is('admin/user/*') ? ' active' : '') !!}">
          <a href="#"><i class="fa fa-user"></i> <span>Manage Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li{!! (Request::is('admin/users') || Request::is('admin/users/*') ? ' class="active"' : '') !!}><a href="{{ url('admin/users') }}"><i class="fa fa-circle-o"></i> View Users</a></li>
            <li{!! (Request::is('admin/user/create') ? ' class="active"' : '') !!}><a href="{{ url('admin/user/create') }}"><i class="fa fa-circle-o"></i> Create User</a></li>
          </ul>
        </li>
        <li class="treeview {!! (Request::is('admin/groups') || Request::is('admin/groups/*')  || Request::is('admin/group/*') ? ' active' : '') !!}">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Groups</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li{!! (Request::is('admin/groups') || Request::is('admin/groups/*') ? ' class="active"' : '') !!}><a href="{{ url('admin/groups') }}"><i class="fa fa-circle-o"></i> View Groups</a></li>
            <li{!! (Request::is('admin/group/create') ? ' class="active"' : '') !!}><a href="{{ url('admin/group/create') }}"><i class="fa fa-circle-o"></i> Create Group</a></li>
          </ul>
        </li>
        <li class="treeview {!! (Request::is('admin/shop/') || Request::is('admin/shop/*') ? ' active' : '') !!}">
          <a href="#"><i class="fa fa-tags"></i> <span>Manage Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li{!! (Request::is('admin/shop/products') || Request::is('admin/shop/products/*') ? ' class="active"' : '') !!}><a href="{{ url('admin/shop/products') }}"><i class="fa fa-circle-o"></i> View Products</a></li>
            <li{!! (Request::is('admin/shop/product/create') ? ' class="active"' : '') !!}><a href="{{ url('admin/shop/product/create') }}"><i class="fa fa-circle-o"></i> Create Product</a></li>
            <li{!! (Request::is('admin/shop/categories') || Request::is('admin/shop/categories/*') ? ' class="active"' : '') !!}><a href="{{ url('admin/shop/categories') }}"><i class="fa fa-circle-o"></i> View Categories</a></li>
            <li{!! (Request::is('admin/shop/category/create') ? ' class="active"' : '') !!}><a href="{{ url('admin/shop/category/create') }}"><i class="fa fa-circle-o"></i> Create Category</a></li>
          </ul>
        </li>
        <li class="treeview {!! (Request::is('admin/orders') || Request::is('admin/orders/*')  || Request::is('admin/order/*') ? ' active' : '') !!}">
          <a href="#"><i class="fa fa-shopping-cart"></i> <span>Manage Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li{!! (Request::is('admin/orders') || Request::is('admin/orders/*') ? ' class="active"' : '') !!}><a href="{{ url('admin/orders') }}"><i class="fa fa-circle-o"></i> View Orders</a></li>
            <li{!! (Request::is('admin/order/create') ? ' class="active"' : '') !!}><a href="{{ url('admin/order/create') }}"><i class="fa fa-circle-o"></i> Create Order</a></li>
          </ul>
        </li>
      </ul>
      
    </section>
    
  </aside>


@yield('body')




  
  <footer class="main-footer">
    
    <div class="pull-right hidden-xs">
      Powered by Laravel.
    </div>
    
    <strong>Copyright &copy; 2018 <a href="{{ url('/') }}"> {{ env('SITE_NAME') }}</a>.</strong> All rights reserved.
  </footer>

  
  <aside class="control-sidebar control-sidebar-dark">
    
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    
    <div class="tab-content">
      
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        

      </div>
      
      
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      
      
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          
        </form>
      </div>
      
    </div>
  </aside>
  
  
  <div class="control-sidebar-bg"></div>
</div>

<div style="display: none;" id="animatedModal" class="animated-modal text-center p-5">
    <h2>Success!</h2>
    <p>File successfully deleted.</p>
    <br>
    <p class="mb-0">
        <svg width="150" height="150" viewBox="0 0 510 510" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <path fill="#fff" d="M150.45,206.55l-35.7,35.7L229.5,357l255-255l-35.7-35.7L229.5,285.6L150.45,206.55z M459,255c0,112.2-91.8,204-204,204 S51,367.2,51,255S142.8,51,255,51c20.4,0,38.25,2.55,56.1,7.65l40.801-40.8C321.3,7.65,288.15,0,255,0C114.75,0,0,114.75,0,255 s114.75,255,255,255s255-114.75,255-255H459z"></path>
        </svg>
    </p>
</div>

<script src="{{url('media/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('media/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{url('media/js/bootstrap.min.js')}}"></script>@yield('scripts')  
<script src="{{url('media/js/app.min.js')}}"></script>
<script src="{{url('media/js/admin-scripts.js')}}"></script>
</body>
</html>