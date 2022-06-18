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
            this.$inertia.get(route('roles.edit',{'role': data.id}));
        }
    }
}

</script>

<template>

    <Head title="Role List" />
    <AppLayout>
            <h1 class="mb-8 text-2xl font-bold flex gap-2 items-center">
                <Link class="text-primary hover:text-primary-focus" href="/users">User</Link>
                <span class="text-primary font-medium">/</span> Roles
            </h1>
                <div class="flex items-end justify-end mb-3">
                    <Link class="btn btn-neutral btn-sm" :href="route('roles.create')"> Add New Role</Link>
                </div>

                <table class="table table-bordered w-full">
                    <thead>
                        <tr>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover hover:cursor-pointer" v-for="role in $page.props.roles" :key="role.Id"
                            @click="goToViewPage(role)">
                            <td>{{ role.portfolio_name }} - {{ role.name }}</td>
                        </tr>
                    </tbody>
                </table>
            </AppLayout>

</template>
