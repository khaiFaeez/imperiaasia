<script setup>
import { ref, onMounted } from 'vue'
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import Navigation from '@/Components/Navigation.vue'
import { Link } from '@inertiajs/inertia-vue3'

const showingNavigationDropdown = ref(false)

let animate = false

onMounted(() => {
    animate = true
})
</script>

<template>
    <div class="absolute bottom-5 inset-x-0 max-w-xl z-20" v-if="$page.props.flash.message" x-data="{show: true}"
        x-init="setTimeout(() => show = false, 5000)" x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90" x-show="show">
        <div class="alert alert-success text-white">
            <p>{{ $page.props.flash.message }}</p>
        </div>
    </div>
    <div class="min-h-screen relative">
        <div class="drawer drawer-mobile">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col">
                <!-- Page content here -->
                <Navigation />
                <main class="py-6 px-4 sm:px-6 lg:px-8 w-full h-full overflow-y-scroll bg-white">
                    <transition name="page" mode="out-in">
                        <div>
                            <div class="alert alert-error shadow-lg" v-if="
                                Object.keys($page.props.errors).length > 0
                            ">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Please Check the errors in the
                                        field</span>
                                </div>
                            </div>
                            <slot />
                        </div>
                    </transition>
                </main>
            </div>
            <div class="drawer-side bg-neutral text-neutral-content overflow-y-visible">
                <label for="my-drawer-2" class="drawer-overlay"></label>
                <ul class="menu menu-compact w-40 xl:w-80 p-0 px-4 overflow-y-auto">
                    <div class="h-20 flex items-center justify-center">
                        <Link :href="route('portfolio.dashboard')">
                        <BreezeApplicationLogo class="block w-auto px-4" />
                        </Link>
                    </div>
                    <!-- Sidebar content here -->
                    <li>
                        <BreezeResponsiveNavLink :href="route('portfolio.dashboard')"
                            :active="route().current('*.dashboard')">
                            <svg xmlns=" http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            Dashboard
                        </BreezeResponsiveNavLink>
                    </li>
                    <li v-if="
                        hasAnyPermission([
                            'client-list',
                            'client-edit',
                            'client-create'
                        ])
                    ">
                        <BreezeResponsiveNavLink :href="route('portfolio.client.index')"
                            :active="route().current('*.client.*')">
                            <svg xmlns=" http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Client
                        </BreezeResponsiveNavLink>
                    </li>
                    <li v-if="
                        hasAnyPermission([
                            'invoice-list',
                            'invoice-edit',
                            'invoice-create'
                        ])
                    ">
                        <BreezeResponsiveNavLink :href="route('portfolio.invoice.index')"
                            :active="route().current('*.invoice.*')">
                            <svg xmlns=" http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Invoice
                        </BreezeResponsiveNavLink>
                    </li>

                    <li v-if="
                        hasAnyPermission([
                            'invoice-list',
                            'invoice-edit',
                            'invoice-create'
                        ])
                    ">
                        <BreezeResponsiveNavLink :href="route('portfolio.print.view.invoice')"
                            :active="route().current('*.print.*')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Printing
                        </BreezeResponsiveNavLink>
                    </li>
                    <li v-if="
                        hasAnyPermission([
                            'user-list',
                            'user-edit',
                            'user-create'
                        ])
                    ">
                        <BreezeResponsiveNavLink :href="route('users.index')" :active="route().current('users.*')">
                            <i class="bi bi-person text-xl"></i>
                            Users
                        </BreezeResponsiveNavLink>
                    </li>

                    <li v-if="
                        hasAnyPermission([
                            'role-list',
                            'role-edit',
                            'role-create'
                        ])
                    ">
                        <BreezeResponsiveNavLink :href="route('roles.index')" :active="route().current('roles.*')">
                            <i class="bi bi-person text-xl"></i>
                            Roles
                        </BreezeResponsiveNavLink>
                    </li>
                </ul>

                <small class="fixed bottom-0">Kagi &copy;</small>
            </div>
        </div>
    </div>
</template>

<style>
.page-enter-active,
.page-leave-active {
    transition: all 5s;
}

.page-enter-from,
.page-leave-to {
    opacity: 0;
}
</style>
