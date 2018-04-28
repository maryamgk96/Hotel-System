<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <br><br>
        <ul class="sidebar-menu" data-widget="tree">
            @role('admin')
            <li><a href="/managers"><i class="fa fa-circle-o"></i> Manage Managers</a></li>
            <li><a href="/receptionists"><i class="fa fa-circle-o"></i> Manage Receptionists</a></li>
            <li><a href="/clients"><i class="fa fa-circle-o"></i> Manage Clients</a></li>
            <li><a href="/floors"><i class="fa fa-circle-o"></i> Manage Floors</a></li>
            <li><a href="/rooms"><i class="fa fa-circle-o"></i> Manage Rooms</a></li>
            <li><a href="/reservations"><i class="fa fa-circle-o"></i>  Clients Reservations</a></li>
            @endrole
            @role('manager')
            <li><a href="/receptionists"><i class="fa fa-circle-o"></i> Manage Receptionists</a></li>
            <li><a href="/clients"><i class="fa fa-circle-o"></i> Manage Clients</a></li>
            <li><a href="/floors"><i class="fa fa-circle-o"></i> Manage Floors</a></li>
            <li><a href="/rooms"><i class="fa fa-circle-o"></i> Manage Rooms</a></li>
            <li><a href="/reservations"><i class="fa fa-circle-o"></i> Clients Reservations</a></li>
            @endrole
            @role('receptionist')
            <li><a href="/clients"><i class="fa fa-circle-o"></i> Manage Clients</a></li>
            <li><a href="/clients/myclients"><i class="fa fa-circle-o"></i>  My Approved Clients</a></li>
            <li><a href="/reservations"><i class="fa fa-circle-o"></i>  Clients Reservations</a></li>
            @endrole
            
            <?php $client=Auth::guard('client')->user(); 
            if($client){
            ?>
            <li><a href="/reservations"><i class="fa fa-circle-o"></i> My Reservations</a></li>
            <li><a href="/reservations/rooms"><i class="fa fa-circle-o"></i>  Make Reservation</a></li>
            <?php
            }
            ?>


        </ul>

    </section>
    <!-- /.sidebar -->
</aside>