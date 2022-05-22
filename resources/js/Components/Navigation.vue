<script setup>
import { ref } from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Navigation from '@/Components/Navigation.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
<nav class="navbar bg-base-300 ">
  <div class="navbar-start">
    <div class="dropdown">
      <label tabindex="0" class="btn btn-ghost lg:hidden">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>

      </label>
                            <div class="dropdown inline-block lg:hidden">
                                <label tabindex="0" class="btn btn-ghost m-1 text-xl"> {{ $page.props.auth.user.current_portfolio.name }} <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z"/></svg></label>
                                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 ">
                                    <li v-for="(value,key) in $page.props.portfolio?.list" :key="key"><Link :href="route('portfolio.change',{portfolio:key})" method="post" as="button">{{value}}</Link ></li>
                                </ul>
                            </div>
    </div>
    <Link :href="route('portfolio.dashboard')">
        <BreezeApplicationLogo class="block w-auto px-4" />
    </Link>
  </div>
  <div class="navbar-center hidden lg:flex">
                            <div class="dropdown">
                                <label tabindex="0" class="btn btn-ghost m-1 text-xl no-animation"> {{ $page.props.auth.user.current_portfolio.name }} <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg></label>
                                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                    <li v-for="(value,key) in $page.props.portfolio?.list" :key="key"><Link :href="route('portfolio.change',{portfolio:key})" method="post" as="button">{{value}}</Link ></li>
                                </ul>
                            </div>
  </div>
  <div class="navbar-end">
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn m-1 btn-ghost ">   {{ $page.props.auth.user.name }}</label>
            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                <li><Link :href="route('logout')" method="post" as="button"> Log Out</Link ></li>
                <li><Link :href="route('users.index')"> Manage Users</Link ></li>
                <li><Link :href="route('roles.index')"> Manage Roles</Link ></li>
            </ul>
        </div>
  </div>
</nav>

</template>
