<script>
import { ref } from 'vue'
import { Link, Head } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/Authenticated.vue'
import Pagination from '@/Components/Pagination'
import moment from 'moment'
import BreezeButton from '@/Components/Button.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from '@/Components/InputError.vue'

const showingNavigationDropdown = ref(false)

export default {
    components: {
        Pagination,
        AppLayout,
        BreezeLabel,
        BreezeButton,
        BreezeInput,
        BreezeInputError,
        Link,
        Head
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'PUT',
                name: this.$page.props.role.name,
                permission: Object.values(this.$page.props.rolePermissions)
            })
        }
    },
    created: function () {
        this.moment = moment
    },
    methods: {
        updateRole(id) {
            this.form.post(route('roles.update', { role: id }), {
                errorBag: 'updateRoles',
                preserveScroll: true
            })
        }
    }
}
</script>

<template>
    <Head title="Edit Roles" />
    <AppLayout>
        <h1 class="mb-8 text-2xl font-bold flex gap-2 items-center">
            <Link class="text-primary hover:text-primary-focus" href="/users"
                >User</Link
            >
            <Link class="text-primary hover:text-primary-focus" href="/roles">
                <span class="text-primary font-medium">/</span> Roles</Link
            >
            <span class="text-primary font-medium">/</span
            ><span class="capitalize">{{ $page.props.role.name }}</span>
            <span class="badge badge-lg capitalize">{{
                $page.props.role.portfolio_name
            }}</span>
        </h1>

        <form @submit.prevent="updateRole($page.props.role.id)" class="form">
            <div class="flex items-center justify-end gap-4">
                <BreezeButton
                    :class="{ 'loading mr-3': form.processing }"
                    :disabled="form.processing"
                >
                    Save
                </BreezeButton>
            </div>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6">
                    <BreezeLabel>Name:</BreezeLabel>
                    <BreezeInput
                        id="name"
                        type="text"
                        v-model="form.name"
                        required
                        autocomplete="name"
                        class="max-w-xl"
                    />
                </div>

                <div class="col-span-6">
                    <BreezeLabel>Permission:</BreezeLabel>
                    <div
                        v-for="(permission, i) in $page.props.permissions"
                        :key="i"
                    >
                        <input
                            class="checkbox checkbox-sm"
                            type="checkbox"
                            name="permission[]"
                            v-model="form.permission"
                            :value="permission.id"
                        />
                        <label class="mx-3"> {{ permission.name }}</label>
                    </div>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
