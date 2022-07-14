<div class="iconsidebar-menu  iconbar-mainmenu-close">
   <div class="sidebar">
      <ul class="iconMenu-bar custom-scrollbar">
         <li>
            <a class="bar-icons" href="{{ route('admin_dashboard') }}">
               <!--img(src='../assets/images/menu/home.png' alt='')--><i class="pe-7s-home"></i><span>Dashboard    </span>
            </a>
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
         <li>
            <a class="bar-icons" href="{{url('Hr_SeatingRequest')}}"><i class="pe-7s-paperclip"></i></i><span>Seating Request</span></a>
         </li>
      </ul>
   </div>
</div>
