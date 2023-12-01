<div id="load" class="row" style="margin: 10px 10px;">
    <div class="col admin-menu-tab {{ Request::segment(2) == 'filter-items' ? 'active' : '' }}"><a
            href="{{ url('admin/filter-items') }}">Filter Items</a></div>
    <div class="col admin-menu-tab {{ Request::segment(2) == 'home-sliders' ? 'active' : '' }}"><a
            href="{{ url('admin/home-sliders') }}">Home Sliders</a></div>
    <div class="col admin-menu-tab {{ Request::segment(1) == 'upload-excel' ? 'active' : '' }}"><a
            href="{{ url('upload-excel') }}">Upload Excel</a></div>
    <div class="col admin-menu-tab {{ Request::segment(2) == 'volunteers' ? 'active' : '' }}"><a
            href="{{ url('admin/volunteers') }}">Volunteers</a></div>
    <div class="col admin-menu-tab {{ Request::segment(2) == 'mission' ? 'active' : '' }}"><a
            href="{{ url('admin/mission') }}">Our Mission</a></div>
    <div class="col admin-menu-tab {{ Request::segment(2) == 'peoples-review' ? 'active' : '' }}"><a
            href="{{ url('admin/peoples-review') }}">Peoples Review</a></div>
    <div class="col admin-menu-tab {{ Request::segment(2) == 'subscriptions' ? 'active' : '' }}"><a
            href="{{ url('admin/subscriptions') }}">Subscriptions</a></div>
    <div class="col admin-menu-tab {{ Request::segment(2) == 'founder' ? 'active' : '' }}"><a
            href="{{ url('admin/founder') }}">Founder</a></div>
    <div class="col admin-menu-tab {{ Request::segment(2) == 'contact-us' ? 'active' : '' }}"><a
            href="{{ url('admin/contact-us') }}">Contact Us</a></div>
</div>