<!-- Main Header -->
<header class="main-header" style ="margin-left:0px">
   
  <!-- Logo -->
  <a href="/home" class="logo"><b>Hotel</b>System</a>
  <nav class="navbar navbar-static-top">
    <div style="  padding-right: 40px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;">
      <div class="navbar-header">
       
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
             
              <img src="{{ url(Auth::guard('client')->user()->avatar) }}" class="user-image">

              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">

                {{Auth::guard('client')->user()->name}}
                
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">

                  <img src="{{ url(Auth::guard('client')->user()->avatar) }}" class="user-image">
              
                <p>
              <span class="hidden-xs">
                {{Auth::guard('client')->user()->name}}
                </p>
              </li>
              <li class="user-footer">

                <div class="pull-left">
    
                 <a href="/profilee/{{Auth::guard('client')->user()->id}}/edit" class="btn btn-default btn-flat">Edit Profile</a>

                </div>
                <div class="pull-right">
                  
                   <a href="{{ url('/client/logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                   Logout
                   </a>
               <form id="logout-form" action="{{ url('/client/logout') }}" method="POST" style="display: none;">
               {{ csrf_field() }}
              </form>

                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>

</header>