   <nav class="navbar navbar-header navbar-expand-lg">
       <div class="container-fluid">
           <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
               <li class="nav-item dropdown">
                   <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img
                           src="/assets/img/profile.jpg" alt="user-img" width="36"
                           class="img-circle"><span>{{ Auth::user()->name }}</span></span> </a>
                   <ul class="dropdown-menu dropdown-user">

                       <div class="dropdown-divider"></div>
                       @if (Auth::check())
                           <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                               @csrf
                               <button type="submit" class="dropdown-item"
                                   style="border: none; background: none; cursor: pointer;">
                                   <i class="fa fa-power-off"></i> Logout
                               </button>
                           </form>
                       @endif

                   </ul>

               </li>
           </ul>
       </div>
   </nav>
