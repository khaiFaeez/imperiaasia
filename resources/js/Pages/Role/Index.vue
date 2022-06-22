<script>
import { ref } from 'vue';
import { Link, Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination'
import SearchFilter from '@/Components/SearchFilter'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'

const showingNavigationDropdown = ref(false);


export default {
    props: [
        'roles', 'filters'
    ],

    components:{
        Pagination,
        AppLayout,
        Link,
        Head,
        SearchFilter
    },
    data() {
        return {
            form: {
                search: this.filters.search,
            },
        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(route('roles.index'), pickBy(this.form), { preserveState: true })
            }, 150),
        },
    },
    methods: {
        goToViewPage(data) {
            this.$inertia.get(route('roles.edit',{'role': data.id}));
        },
        reset() {
            this.form = {
                search: null,
            }
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
        <div class="flex items-end justify-between mb-3">
            <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
            </search-filter>
            <Link class="btn btn-neutral btn-sm" :href="route('roles.create')"> Add New Role</Link>
        </div>

        <table class="table table-compact table-bordered w-full">
            <thead>
                <tr>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover hover:cursor-pointer" v-for="role in $page.props.roles" :key="role.Id"
                    @click="goToViewPage(role)">
                    <td>{{ role.name }}</td>
                </tr>
            </tbody>
        </table>
    </AppLayout>

</template>
