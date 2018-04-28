<!-- Main Header -->
<header class="main-header" style ="margin-left:0px">
   
  <!-- Logo -->
  <a href="/home" class="logo"><b>Hotel</b>System</a>
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
       
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">

        
        <?php  $user = Auth::user(); 
              $client=Auth::guard('client')->user(); 
      while(!$user && !$client){
        ?>
      
          <li class="active"><a href="/login">Login As Admin<span class="sr-only">(current)</span></a></li>
      
          <li class="active"><a href="/client/login">Login As Client<span class="sr-only">(current)</span></a></li>
          <li><a href="/client/register">Register As Client</a></li>
          <?php
      }
      ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
      <?php  $user = Auth::user(); 
              $client=Auth::guard('client')->user(); 
      if($user || $client){
        ?>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <?php if($user):                
              ?>
              <img src="{{ url(Auth::user()->avatar) }}" class="user-image" >
              <?php elseif($client): 
              ?>
              <img src="{{ url(Auth::guard('client')->user()->avatar) }}" class="user-image">
              <?php endif; ?>
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php  if($user){?>
                {{Auth::user()->name}}<?php
                } 
                elseif($client){?>
                {{Auth::guard('client')->user()->name}}<?php
                }
                ?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                  <?php if($user):                
                  ?>
                  <img src="{{ url(Auth::user()->avatar) }}" class="user-image" >
                  <?php elseif($client): 
                  ?>
                  <img src="{{ url(Auth::guard('client')->user()->avatar) }}" class="user-image">
                  <?php endif; ?>
                <p>
              <span class="hidden-xs"><?php  if($user){?>
                {{Auth::user()->name}}<?php
                } 
                elseif($client){?>
                {{Auth::guard('client')->user()->name}}<?php
                }
                ?>
                </p>
              </li>
              <li class="user-footer">

                <div class="pull-left">
                <?php  if($user){?>
                  <a href="profile/{{Auth::user()->id}}/edit" class="btn btn-default btn-flat">Edit Profile</a>
                  <?php
                } 
                elseif($client){?>
                 <a href="/clients/{{Auth::guard('client')->user()->id}}/edit" class="btn btn-default btn-flat">Edit Profile</a>
                <?php } ?>
                </div>
                <div class="pull-right">
                    <?php  if($user): ?>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                       {{ __('Logout') }}
                   </a>
                   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                  <?php 
                   elseif($client) : ?>
                   <a href="{{ url('/client/logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                   Logout
                   </a>
               <form id="logout-form" action="{{ url('/client/logout') }}" method="POST" style="display: none;">
               {{ csrf_field() }}
              </form>
                   <?php endif ?>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <?php
      }
      ?>
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>

</header>