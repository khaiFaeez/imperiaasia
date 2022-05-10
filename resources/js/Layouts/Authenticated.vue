<script setup>
import { ref } from 'vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Navigation from '@/Components/Navigation.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);

</script>

<template>
    <div>
        <div class="absolute bottom-5 inset-x-0 max-w-xl z-20" v-if="$page.props.flash.message" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" x-show="show">
                <div class="alert alert-success text-white">
                    <p>{{ $page.props.flash.message }}</p>
                </div>
        </div>
        <div class="min-h-screen relative">

                <Navigation/>

            <div class="drawer drawer-mobile h-[calc(100vh-4rem)]">
                <input id="my-drawer-2" type="checkbox" class="drawer-toggle">
                <div class="drawer-content flex flex-col">
                                <!-- Page content here -->
                                <main class="mx-auto py-6 px-4 sm:px-6 lg:px-8 w-full">
                                    <slot />
                                </main>
                </div>
                <div class="drawer-side" v-if="route().params.portfolio">
                    <label for="my-drawer-2" class="drawer-overlay"></label>
                    <aside class="w-80 bg-base-200">
                    <ul class="menu menu-compact flex flex-col p-0 px-4 overflow-y-auto" >
                    </ul>

                    <div class="h-4"></div>

                    <ul class="menu menu-compact flex flex-col p-0 px-4 overflow-y-auto">
                    <!-- Sidebar content here -->
                    <li>
                        <BreezeResponsiveNavLink :href="route('portfolio.client.index',{portfolio:route().params.portfolio})"  :active="route().current('*.client.*')">
                            Client
                        </BreezeResponsiveNavLink>
                    </li>
                    <li>
                        <BreezeResponsiveNavLink :href="route('portfolio.invoice.index',{portfolio:route().params.portfolio})"  :active="route().current('*.invoice.*')" >
                            Invoice
                        </BreezeResponsiveNavLink>
                    </li>
                    </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</template>
