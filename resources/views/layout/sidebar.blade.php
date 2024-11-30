 <div class="sidebar">
     <div class="scrollbar-inner sidebar-wrapper">
         <ul class="nav">
             <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
                 <a href="/dashboard">
                     <i class="la la-dashboard"></i>
                     <p>Dashboard</p>

                 </a>
             </li>
             <li class="nav-item {{ request()->routeIs('teachers.index') || request()->routeIs('teacher.edit') ? 'active' : '' }}">
                 <a href="/teachers">
                     <i class="la la-mortar-board"></i>
                     <p>Data guru</p>

                 </a>
             </li>
             <li class="nav-item {{ request()->routeIs('students.index') || request()->routeIs('student.edit') ? 'active' : '' }}">
                 <a href="/students">
                     <i class="la la-user"></i>
                     <p>Data Siswa</p>

                 </a>
             </li>
             <li class="nav-item {{ request()->routeIs('class.index') || request()->routeIs('class.edit') ? 'active' : '' }}">
                 <a href="/class">
                     <i class="la la-bell"></i>
                     <p>Data Kelas</p>

                 </a>
             </li>
         </ul>
     </div>
 </div>