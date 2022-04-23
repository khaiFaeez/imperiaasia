<script setup>
import { ref } from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Navigation from '@/Components/Navigation.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen">
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
                <div class="h-4"></div>
                <ul class="menu menu-compact flex flex-col p-0 px-4 overflow-y-auto" >
                <!-- Sidebar content here -->

                <li>
                    <Link :href="route('portfolio.invoice.create',{portfolio:route().params.portfolio})" v-if="route().current('*.invoice.*')" class="btn btn-primary text-white">
                        Create Invoice
                    </Link>
                </li>

                </ul>
                <div class="h-4"></div>
                <ul class="menu menu-compact flex flex-col p-0 px-4 overflow-y-auto">
                <!-- Sidebar content here -->
                 <li>
                    <BreezeResponsiveNavLink :href="route('portfolio.client.index',{portfolio:route().params.portfolio})">
                            Client
                    </BreezeResponsiveNavLink>
                </li>
                <li>
                    <BreezeResponsiveNavLink :href="route('portfolio.invoice.index',{portfolio:route().params.portfolio})">
                       Invoices
                    </BreezeResponsiveNavLink>
                </li>
                <li><BreezeResponsiveNavLink>Aging</BreezeResponsiveNavLink></li>
                <li><BreezeResponsiveNavLink>Quick Order</BreezeResponsiveNavLink></li>
                <li><BreezeResponsiveNavLink>Print PDF</BreezeResponsiveNavLink></li>
                <li><BreezeResponsiveNavLink>Print Docket</BreezeResponsiveNavLink></li>
                </ul>
                </aside>
        </div>
        </div>
        </div>
    </div>
</template>
