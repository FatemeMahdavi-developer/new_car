<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand" style="height:40px">
            <a href="javascript:void(0)" >
                <img alt="تصویر" src="{{asset("admin/assets/img/logo.png")}}" class="header-logo">
                <span class="logo-name">اجیس</span>
            </a>
        </div>

        <div class="sidebar-user">
            <div class="sidebar-user-picture">
                <img src="{{asset("admin/assets/img/userbig.jpg")}}"  style="border: 1px solid #ddd">
            </div>
            <div class="sidebar-user-details">
                <div class="user-name">ادمین</div>
                <div class="user-role">دسترسی کل</div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-v"></i><span>دسته بندی محصول</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route("admin.productcat.create")}}" wire:navigate>افزودن</a></li>
                    <li><a class="nav-link" href="{{route("admin.productcat.index")}}" wire:navigate>لیست</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
