<div class="col-12 col-lg-3 col-xl-2 vh-100 sidebar">
    <div class="d-flex justify-content-between align-items-center py-2 nav-brand">
        <div class="d-flex align-items-center justify-content-between">
                    <span class="p-2 rounded d-flex justify-content-center align-items-center mr-2">
                       <img src="{{ asset('logo/logo.png') }}" class="logoImg" alt="">
                    </span>
            <span class="font-weight-bolder h4 mb-0 text-uppercase text-primary">IT News</span>
        </div>
        <button class="hide-sidebar-btn btn btn-light d-block d-lg-none">
            <i class="fa fa-baby  text-primary" style="font-size: 2em;"></i>
        </button>
    </div>
    <div class="nav-menu">
        <ul>
            <x-menu-item link="{{ route('home') }}" class="fa fa-home " name="Home"></x-menu-item>
            <x-menu-item count="{{ count(\App\Category::all()) }}" link="{{ route('category.index') }}" class="fa fa-layer-group " name="Category "></x-menu-item>
            <x-menu-item link="{{ route('article.create') }}" class="fa fa-plus-circle " name="Create Article"></x-menu-item>
            <x-menu-item count="{{ count(\App\Article::all()) }}" link="{{ route('article.index') }}" class="fa fa-list-alt " name=" Article List"></x-menu-item>
{{--                <x-menu-item link="changeNameAndEmail" class="fa fa-cart-plus " name="Add List"></x-menu-item>--}}

{{--            //user management//--}}
            @if(\Illuminate\Support\Facades\Auth::user()->role == 0)
            <x-menu-header title="User Management"></x-menu-header>
            <x-menu-item link="{{ route('userManagement') }}" class="fa fa-user-shield" name="Users" ></x-menu-item>
            @endif
           <x-menu-header title="New Dashboard"/>

            <x-menu-item link="{{ route('showInfo') }}" class="fa fa-user-alt" name=" User Profile "></x-menu-item>
            <x-menu-item link="{{ route('name') }}" class="fa fa-envelope-open " name=" Name && Email"></x-menu-item>
            <x-menu-item link="{{ route('showPassword') }}" class="fa fa-lock" name="Change Password  "></x-menu-item>
            <x-menu-item link="{{ route('showPhoto') }}" class="fa fa-passport " name="Change Photo"></x-menu-item>

            <li class="menu-spacer"></li>


            {{-- Log out section --}}
            <a class="btn btn-outline-danger d-block w-100" href="{{ route('logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </div>
</div>
