<div class="iconsidebar-menu  iconbar-mainmenu-close">
    <div class="sidebar">
       <ul class="iconMenu-bar custom-scrollbar">
          <li>
             <a class="bar-icons" href="{{ route('candidate_dashboard') }}">
                <!--img(src='../assets/images/menu/home.png' alt='')--><i class="pe-7s-home"></i><span>Dashboard    </span>
             </a>
          </li>
          <li>
             <a class="bar-icons bar-icons-hover" href="#"><i class="pe-7s-portfolio"></i><span>Pre OnBoarding</span></a>
             <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">Pre OnBoarding</li>
                <li><a href="{{url('preOnboarding')}}">Pre OnBoarding</a></li>
                <li><a href="{{url('Candidate_Induction')}}">Induction Schedule</a></li>
                <li><a href="{{url('Candidate_Assigned_Buddy')}}">Buddy Info </a></li>
                <li><a href="{{url('Buddy_feedback')}}">Buddy Feedback</a></li>
                <li><a href="{{ url('view_welcome_aboard') }}">Welcome Aboard</a></li>
             </ul>
          </li>
          <li>
             <span class="badge badge-pill badge-danger">Hot</span><a class="bar-icons" href="#"><i class="pe-7s-diamond"></i><span>Profile</span></a>
              <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">Profile</li>
                <li><a href="{{url('../candidate_profile')}}">My Profile</a></li>
             </ul>
          </li>

       </ul>
    </div>
</div>
