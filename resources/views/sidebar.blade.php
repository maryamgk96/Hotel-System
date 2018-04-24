<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
        
@role('admin')
            <li><a href="#"><span>Manage Mangers</span></a></li>
    @role('manager')           
            <li><a href="#"><span>Manage Receptionists</span></a></li>
        @role('receptionist') 
            <li><a href="#"><span>Manage Clients</span></a></li>
            <li><a href="/floors"><span>Manage Floors</span></a></li>
            <li><a href="/rooms"><span>Manage Rooms</span></a></li>
            <li><a href="#"><span>My Approved Clients</span></a></li>
            <li><a href="#"><span>Clients Reservations</span></a></li>
            <li><a href="#"><span>Edit Profile</span></a></li>
        @endrole
    @endrole
@endrole
            <li><a href="/reservations"><span>My Reservations</span></a></li>
            <li><a href="/reservations/rooms"><span>Make Reservation</span></a></li>
            <li><a href="#"><span>Register</span></a></li>
    
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>