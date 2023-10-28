<div id="load" class="row" style="margin: 10px 10px;">
    <div class="col admin-menu-tab {{ Request::segment(2) == 'filter-items' ? 'active' : '' }}"><a
            href="{{ url('admin/filter-items') }}">Filter Items</a></div>
    <div class="col admin-menu-tab {{ Request::segment(2) == 'home-sliders' ? 'active' : '' }}"><a
            href="{{ url('admin/home-sliders') }}">Home Sliders</a></div>
    <div class="col admin-menu-tab {{ Request::segment(1) == 'upload-excel' ? 'active' : '' }}"><a
            href="{{ url('upload-excel') }}">Upload Excel</a></div>
    <div class="col admin-menu-tab {{ Request::segment(2) == 'volunteers' ? 'active' : '' }}"><a
            href="{{ url('admin/volunteers') }}">Volunteers</a></div>
</div>