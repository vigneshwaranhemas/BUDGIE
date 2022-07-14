<div class="iconsidebar-menu iconbar-mainmenu-close">
   <div class="sidebar">
      <ul class="iconMenu-bar custom-scrollbar">
         <li>
            <a class="bar-icons" href="{{ route('admin_dashboard') }}">
               <!--img(src='../assets/images/menu/home.png' alt='')--><i class="pe-7s-home"></i><span>Dashboard    </span>
            </a>
         </li>
         <li>
            <a class="bar-icons bar-icons-hover" href="#"><i class="pe-7s-portfolio"></i><span>Masters</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Masters</li>
               <li><a href="{{ route('employee_list') }}">Employee List</a></li>
               <li><a href="{{ route('business') }}">Business Unit</a></li>
               <li><a href="{{ route('division') }}">Division</a></li>
               <li><a href="{{ route('function') }}">Function </a></li>
               <li><a href="{{ route('grade') }}">Grade</a></li>
               <li><a href="{{ route('band') }}">Band</a></li>
               <li><a href="{{ route('location') }}">Work Location</a></li>
               <li><a href="{{ route('blood') }}">Blood Group</a></li>
               <li><a href="{{ route('roll') }}">Roll of Intake</a></li>
               <li><a href="{{ route('department') }}">Department</a></li>
               <li><a href="{{ route('designation_or_position') }}">Designation or Position</a></li>
               <li><a href="{{ route('client') }}">Client</a></li>
               <li><a href="{{ route('state') }}">State</a></li>
               <li><a href="{{ route('zone') }}">Zone</a></li>
            </ul>
         </li>
         <li>
            <a class="bar-icons bar-icons-hover" href="#"><i class="pe-7s-target"></i><span>Goals</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Goals</li>
                <li><a href="{{ route('goals') }}">Goals</a></li>
               <li><a href="{{ route('goal_setting') }}">Goal Setting</a></li>
            </ul>
         </li>         
         <li>
            <a class="bar-icons" href="{{ route('holidays') }}"><i class="pe-7s-plane"></i><span>Holidays</span></a>
         </li>
         <li>
            <a class="bar-icons" href="{{ route('events') }}"><i class="pe-7s-note"></i><span>Events</span></a>
         </li>
         <li>
            <a class="bar-icons bar-icons-hover" href="#"><i class="pe-7s-note2"></i><span>Settings</span></a>
             <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Settings</li>
               <li><a>Profile Settings</a></li>
               <li><a href="{{url('/permission')}}">Roles & Permissions</a></li>
               <li><a>Function</a>Module Settings</li>
            </ul>
         </li>
      </ul>
   </div>
</div>
