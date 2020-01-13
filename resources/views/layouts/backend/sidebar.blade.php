<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/back/img/user2-160x160.jpg" class="img-circle" alt="{{ Auth::user()->name }}">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li>
          <a href="{{ route('backend.blog.index') }}">
            <i class="fa fa-dashboard"></i><span> Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pencil"></i>
            <span>Blog</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('backend.blog.index') }}"><i class="fa fa-circle-o"></i> All Posts</a></li>
            <li><a href="{{ route('backend.blog.create') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
          </ul>
        </li>
        @role(['admin', 'editor'])
            <li><a href="{{ route('backend.category.index') }}"><i class="fa fa-folder"></i> <span>Categories</span></a></li>
        @endrole
        @role('admin')
            <li><a href="{{ route('backend.user.index') }}"><i class="fa fa-user"></i><span>Users</span></a></li>
        @endrole
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
