<div class="iconsidebar-menu iconbar-mainmenu-close">
    <div class="sidebar">
       <ul class="iconMenu-bar custom-scrollbar">
          <li>
             <a class="bar-icons" href="{{ route('hr_dashboard') }}">
                <!--img(src='../assets/images/menu/home.png' alt='')--><i class="pe-7s-home"></i><span>Dashboard    </span>
             </a>
          </li>
          <li>
             <a class="bar-icons  bar-icons-hover" href="#"><i class="pe-7s-portfolio"></i><span>Pre OnBoarding  </span></a>
             <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">Pre OnBoarding</li>
                <li><a href="{{url('hrsspreOnboarding')}}">Pre OnBoarding</a></li>
                <li><a href="{{url('hrssdayzero')}}">Day Zero</a></li>
                <li><a href="{{url('hrssOnBoarding')}}">On Boarding </a></li>
                <li><a href="{{url('seating_readiness')}}">Seating  & IdCard Request </a></li>
                <li><a href="{{url('EmailIdCreation')}}">Email IdCreation </a></li>
             </ul>
          </li>
          <li>
             <span class="badge badge-pill badge-danger"></span><a class="bar-icons"  href="{{url('hrssCandidate')}}"><i class="pe-7s-diamond"></i><span>Candidate</span></a>

          </li>
          <li>
             <a class="bar-icons" href="#"><i class="pe-7s-note2"></i><span>Profile</span></a>

          </li>

          <li>
             <a class="bar-icons bar-icons-hover" href="#"><i class="pe-7s-target"></i><span>Goals </span></a>
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
       </ul>
    </div>
 </div>
