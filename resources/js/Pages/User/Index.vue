<script>
import { ref } from 'vue'
import { Link, Head } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/Authenticated.vue'
import Pagination from '@/Components/Pagination'
import SearchFilter from '@/Components/SearchFilter'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'

const showingNavigationDropdown = ref(false)

export default {
    props: ['users', 'filters'],

    components: {
        Pagination,
        AppLayout,
        Link,
        Head,
        SearchFilter
    },

    data() {
        return {
            form: {
                search: this.filters.search
            }
        }
    },

    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(route('users.index'), pickBy(this.form), {
                    preserveState: true
                })
            }, 150)
        }
    },

    methods: {
        goToViewPage(data) {
            this.$inertia.get(route('users.edit', { user: data.id }))
        },
        reset() {
            this.form = {
                search: null
            }
        }
    }
}
</script>

<template>
    <Head title="User List" />
    <AppLayout>
        <h1 class="mb-4 text-xl font-bold flex gap-2 items-center">
            <Link class="text-primary hover:text-primary-focus" href="/users"
                >User</Link
            >
        </h1>
        <div class="flex flex-row items-center justify-between mb-4">
            <search-filter
                v-model="form.search"
                class="mr-4 w-full max-w-md"
                @reset="reset"
            >
            </search-filter>
            <div class="btn-group bg-white">
                <Link
                    class="btn btn-primary btn-sm"
                    :href="route('users.create')"
                    >Add User</Link
                >
            </div>
        </div>

        <table class="table table-bordered w-full max-w-5xl my-5">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Staff ID</th>
                    <th>Roles</th>
                </tr>
            </thead>
            <tbody>
                <tr v-show="$page.props.users.data.length == 0">
                    <td colspan="5">No user</td>
                </tr>
                <tr
                    class="hover hover:cursor-pointer"
                    v-for="$user in $page.props.users.data"
                    :key="$user.Id"
                    @click="goToViewPage($user)"
                >
                    <td>
                        <label
                            class="badge"
                            :class="
                                $user.deleted_at
                                    ? 'badge-error text-white'
                                    : 'badge-success text-white'
                            "
                        >
                            {{
                                $user.deleted_at ? 'Inactive' : 'Active'
                            }}</label
                        >
                    </td>
                    <td>{{ $user.name }}</td>
                    <td>{{ $user.username }}</td>
                    <td>{{ $user.staff_id }}</td>
                    <td>
                        <label
                            class="badge badge-outline capitalize"
                            v-for="$v in $user.roles"
                            :key="$v.id"
                            >{{ $v.name }}</label
                        >
                    </td>
                </tr>
            </tbody>
        </table>

        <pagination class="mt-6" :links="$page.props.users.links" />
    </AppLayout>
</template>
