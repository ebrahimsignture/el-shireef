<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('event') }}'><i class='nav-icon la la-calendar-check-o'></i> Events</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tag') }}'><i class='nav-icon la la-tag '></i> Tags</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-lg la-sitemap "></i> Services</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link " href="{{ backpack_url('servicecategory') }}"><i class="nav-icon la la-lg la-cubes"></i> Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('service') }}"><i class="nav-icon la la-lg la-sitemap "></i> All Service</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('order') }}'><i class='nav-icon la la-dollar'></i> Orders</a></li>
    </ul>
</li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-lg la-bank"></i> Projects</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link " href="{{ backpack_url('projectcategory') }}"><i class="nav-icon la la-lg la-cubes"></i> Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('project') }}"><i class="nav-icon la la-lg la-bank"></i> All Projects</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon  la-lg la la-leanpub"></i> Products</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('productcategory') }}'><i class="nav-icon la la-lg la-cubes"></i> Categories</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('product') }}'><i class="la la-cubes la-10x nav-icon"></i>All Products</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('productorder') }}'><i class='nav-icon la la-dollar'></i> Orders</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('shipping') }}'><i class='nav-icon la la-ship'></i> Shippings</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-lg la-book"></i>Blog</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link " href="{{ backpack_url('blogcategory') }}"><i class="nav-icon la la-lg la-cubes"></i> Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('post') }}"><i class="nav-icon la la-lg la-book"></i> All Posts</a></li>
    </ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('employee') }}'><i class='nav-icon la la-user '></i> Team Work</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('client') }}'><i class='nav-icon la la-money '></i> Clients</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('review') }}'><i class='nav-icon la la-list-alt'></i> Reviews</a></li>


<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> Settings</a></li>


<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-users '></i> Users</a></li>


















