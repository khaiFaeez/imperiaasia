<script>
import { ref } from 'vue'
import { Link, Head } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/Authenticated.vue'
import Pagination from '@/Components/Pagination'
import BreezeButton from '@/Components/Button.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from '@/Components/InputError.vue'
import UserForm from '@/Components/Forms/UserEditForm.vue'

const showingNavigationDropdown = ref(false)

export default {
    props: {
        status: String
    },
    components: {
        Pagination,
        AppLayout,
        BreezeLabel,
        BreezeButton,
        BreezeInput,
        BreezeInputError,
        Link,
        Head,
        UserForm
    },
    data() {
        return {
            checked: false,
            form: this.$inertia.form({
                _method: 'PUT',
                id: this.$page.props.user.id,
                username: this.$page.props.user.username,
                name: this.$page.props.user.name,
                staff_id: this.$page.props.user.staff_id,
                roles: this.$page.props.userRole
                // permission: Object.keys(this.$page.props.userPermissions)
            })
        }
    },
    methods: {
        updateUser() {
            this.form.post(
                route('users.update', { user: this.$page.props.user.id }),
                {
                    errorBag: 'updateUsersInformation',
                    preserveScroll: true
                }
            )
        },
        deactivate() {
            this.$inertia.delete(
                route('users.destroy', { user: this.$page.props.user.id }),
                {
                    errorBag: 'deactivateUser',
                    preserveScroll: true,
                    onFinish: () => {
                        this.$refs.check.checked = !this.$refs.check.checked
                    }
                }
            )
        },

        reactivate() {
            this.$inertia.post(
                route('users.restore', { user: this.$page.props.user.id }),
                {
                    errorBag: 'restoreUser',
                    preserveScroll: true,
                    onFinish: () => {
                        this.$refs.check.checked = !this.$refs.check.checked
                    }
                }
            )
        }
    }
}
</script>

<template>
    <Head title="Edit User" />
    <AppLayout>
        <div class="w-full">
            <h1 class="mb-8 text-2xl font-bold flex gap-2 items-center">
                <Link
                    class="text-primary hover:text-primary-focus"
                    href="/users"
                    >User</Link
                >
                <span class="text-primary font-medium capitalize">/</span>
                {{ $page.props.user.username }}
            </h1>

            <div class="flex items-end justify-end mb-3 gap-3">
                <Link
                    :href="
                        route('password.reset', { user: $page.props.user.id })
                    "
                    class="hover:underline hover:text-primary hover:cursor-pointer"
                    >Reset Password
                </Link>
                <!-- The button to open modal -->
                <label
                    for="my-modal-4"
                    class="btn modal-button btn-sm btn-error"
                    :title="
                        !$page.props.user.deleted_at ? 'Deactivate' : 'Activate'
                    "
                >
                    <i
                        class="text-xl bi"
                        :class="
                            !$page.props.user.deleted_at
                                ? 'bi-lock'
                                : 'bi-unlock'
                        "
                    ></i>
                </label>
            </div>
            <form @submit.prevent="updateUser" class="form max-w-5xl">
                <div class="bg-white p-12 rounded-xl">
                    <user-form :user="form"></user-form>
                    <!-- <div class="col-span-6">
                            <BreezeLabel>Permission:</BreezeLabel>
                            <div v-for="(permission, i) in $page.props.permissions" :key="i">
                                <input class="checkbox  checkbox-sm" type="checkbox" name="permission[]"
                                    v-model="form.permission" :value="permission.name" />
                                <label class="mx-3"> {{ permission.name }}</label>
                            </div>

                        </div> -->
                    <div class="flex items-center justify-end">
                        <BreezeButton
                            :class="{ 'loading mr-3': form.processing }"
                            :disabled="form.processing"
                        >
                            Update
                        </BreezeButton>
                    </div>
                </div>
            </form>

            <!-- Put this part before </body> tag -->
            <input
                type="checkbox"
                id="my-modal-4"
                class="modal-toggle"
                ref="check"
            />
            <label for="my-modal-4" class="modal cursor-pointer">
                <label class="modal-box relative" for="">
                    <h3 class="text-lg font-bold">Confirm?</h3>
                    <p class="py-4">
                        {{
                            !$page.props.user.deleted_at
                                ? 'Deactivate'
                                : 'Reactivate'
                        }}
                        user?
                    </p>

                    <div class="flex items-end justify-end mb-3">
                        <button
                            v-if="!$page.props.user.deleted_at"
                            class="btn btn-ghost btn-sm mr-3"
                            :class="{ loading: form.processing }"
                            :disabled="form.processing"
                            @click="deactivate"
                        >
                            Yes
                        </button>

                        <button
                            v-else
                            class="btn btn-ghost btn-sm mr-3"
                            :class="{ loading: form.processing }"
                            :disabled="form.processing"
                            @click="reactivate"
                        >
                            Yes
                        </button>

                        <label
                            for="my-modal-4"
                            class="btn btn-ghost btn-sm mr-3"
                            >No</label
                        >
                    </div>
                </label>
            </label>
        </div>
    </AppLayout>
</template>
