<div class="list-group">
    <a href="{{ route('admin.dashboard') }}" 
       class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        Not Onaylama
    </a>
    <a href="{{ route('admin.faculties.index') }}" 
       class="list-group-item list-group-item-action {{ request()->routeIs('admin.faculties.*') ? 'active' : '' }}">
        Fakülte Yönetimi
    </a>
    <a href="{{ route('admin.departments.index') }}" 
       class="list-group-item list-group-item-action {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">
        Bölüm Yönetimi
    </a>
    <a href="{{ route('admin.classes.index') }}" 
       class="list-group-item list-group-item-action {{ request()->routeIs('admin.classes.*') ? 'active' : '' }}">
        Sınıf Yönetimi
    </a>
    <a href="{{ route('admin.courses.index') }}" 
       class="list-group-item list-group-item-action {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
        Ders Yönetimi
    </a>
</div> 