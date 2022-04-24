<script>
import { ref } from 'vue';
import { Link, Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination'

const showingNavigationDropdown = ref(false);


export default {
    components:{
        Pagination,
        AppLayout,
        Link,
        Head
    },
    methods: {
        goToViewPage(data) {
            window.open(route('roles.edit',{'role': data.id}), '_self');
        }
    }
}

</script>

<template>
<Head title="Role List" />
<AppLayout>
    <div class="flex items-end justify-end mb-3">
            <Link class="btn btn-neutral" :href="route('roles.create')"> Add New Role</Link>
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
