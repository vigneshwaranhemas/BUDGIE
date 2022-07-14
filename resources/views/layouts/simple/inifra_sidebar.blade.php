<div class="iconsidebar-menu  iconbar-mainmenu-close">
   <div class="sidebar">
      <ul class="iconMenu-bar custom-scrollbar">
         <li>
            <a class="bar-icons" href="{{ url('ItInfra_Dashboard') }}">
            <i class="pe-7s-home"></i><span>Dashboard</span>
            </a>
         </li>
         <li>
            <a class="bar-icons bar-icons-hover" href="#"><i class="pe-7s-note2"></i><span>Settings</span></a>
         </li>          
         <li>
            <a class="bar-icons" href="#"><i class="pe-7s-target"></i><span>Goals </span></a>
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
            <a class="bar-icons" href="{{url('EmailCreation')}}"><i class="pe-7s-paper-plane"></i></i><span>EmailId Creation </span></a>
         </li>
      </ul>
   </div>
</div>
