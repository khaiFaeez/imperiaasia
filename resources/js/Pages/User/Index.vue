<script>
import { ref } from 'vue';
import { Link,Head } from '@inertiajs/inertia-vue3';
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
            window.open(route('users.edit',{'user': data.id}), '_self');
        }
    }
}

</script>

<template>
<Head title="User List" />
<AppLayout>

        <div class="flex items-end justify-end mb-3">
                <Link class="btn btn-neutral" :href="route('users.create')"> Create New User</Link>
        </div>



    <table class="table table-bordered w-full">
    <thead>
    <tr>
    <th>Name</th>
    <th>Username</th>
    <th>Staff ID</th>
    <th>Status</th>
    <th>Roles</th>
    </tr>
    </thead>
    <tbody>
    <tr class="hover hover:cursor-pointer" v-for="$user in $page.props.users.data" :key="$user.Id" @click="goToViewPage($user)" >
        <td>{{ $user.name }}</td>
        <td>{{ $user.username }}</td>
        <td>{{ $user.staff_id }}</td>
        <td>{{ $user.status }}</td>
        <td>
            <label class="badge badge-success" v-for="$v in $user.roles" :key="$v.id">{{ $v.name }}</label>
        </td>
    </tr>
    </tbody>
    </table>
</AppLayout>

</template>