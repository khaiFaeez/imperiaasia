<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2>General</h2>
                <div class="stats stats-vertical lg:stats-horizontal shadow">

            <div class="stat">
                <div class="stat-title">Invoices</div>
                <div class="stat-value">{{ $page.props.total_invoice.toLocaleString() }}</div>
                <div class="stat-desc"></div>
            </div>

            <div class="stat">
                <div class="stat-title">Users</div>
                <div class="stat-value">{{ $page.props.users.toLocaleString() }}</div>
                <div class="stat-desc"></div>
            </div>

            <div class="stat">
                <div class="stat-title">Portfolios</div>
                <div class="stat-value">{{ Object.keys($page.props.portfolio.list).length}}</div>
                <div class="stat-desc"></div>
            </div>

            </div>

            </div>
        </div>

        <div class="py-12 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2>Account</h2>

            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2>Delivery</h2>

            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2>Setting</h2>

            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
