<script>
import { ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination'

const showingNavigationDropdown = ref(false);


export default {
    components:{
        Pagination,
        AppLayout,
        Link
    },
    methods: {
        goToViewPage(data) {
            window.open(route('roles.edit',{'role': data.id}), '_self');
        }
    }
}

</script>

<template>

<AppLayout>

        <div class="flex items-end justify-end mb-3">
                <Link class="btn btn-neutral" :href="route('roles.create')"> Add New Role</Link>
        </div>

    <div v-if="$page.props.flash.message" x-data="{show: true}" x-init="setTimeout(() => show = false, 1000)" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" x-show="show">
        <div class="alert alert-success">
            <p>{{ $page.props.flash.message }}</p>
        </div>
    </div>

    <table class="table table-bordered w-full">
    <thead>
    <tr>
    <th>Role</th>
    </tr>
    </thead>
    <tbody>
    <tr class="hover hover:cursor-pointer" v-for="$roles in $page.props.roles.data" :key="$roles.Id" @click="goToViewPage($roles)" >
        <td>{{ $roles.name }}</td>
    </tr>
    </tbody>
    </table>
</AppLayout>

</template>
