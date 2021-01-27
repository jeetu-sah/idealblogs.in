<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>
          <li class="nav-item has-treeview">
            <a href="javascript::void()" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{ url('dashboard/page-list') }}" class="nav-link">
                   <i class="nav-icon far fa-circle text-info"></i>
                  <p>Page List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('dashboard/add-page') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Page</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="javascript::void()" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Posts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{ url('dashboard/post-list') }}" class="nav-link">
                   <i class="nav-icon far fa-circle text-info"></i>
                  <p>Posts List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('dashboard/add-post') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Post</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="javascript::void()" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Seo Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{ url('dashboard/url-list') }}" class="nav-link">
                   <i class="nav-icon far fa-circle text-info"></i>
                  <p>Url List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('dashboard/add-url') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Url</p>
                </a>
              </li>
              
            </ul>
          </li>
        </ul>
      </nav>