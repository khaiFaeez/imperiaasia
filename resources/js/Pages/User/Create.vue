<script>
import { Link, Head } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/Authenticated.vue'
import UserForm from '@/Components/Forms/UserForm.vue'
import BreezeButton from '@/Components/Button.vue'

export default {
    props: {
        status: String
    },
    components: {
        AppLayout,
        Link,
        Head,
        UserForm,
        BreezeButton
    },
    data() {
        return {
            form: this.$inertia.form({
                username: '',
                name: '',
                staff_id: '',
                roles: [],
                portfolios: [],
                password: '',
                password_confirmation: ''
            })
        }
    },
    methods: {
        storeUser() {
            this.form.post(route('users.store'), {
                preserveScroll: true
            })
        }
    }
}
</script>

<template>
    <Head title="Create User" />
    <AppLayout>
        <h1 class="mb-4 text-xl font-bold flex gap-2 items-center">
            <Link class="text-primary hover:text-primary-focus" href="/users"
                >User</Link
            >
            <span class="text-primary font-medium">/</span> Create
        </h1>

        <form @submit.prevent="storeUser" class="form max-w-5xl">
            <div class="bg-white p-12 rounded-xl">
                <user-form :user="form"></user-form>
                <div class="flex items-center justify-end">
                    <BreezeButton
                        :class="{ 'loading mr-3': form.processing }"
                        :disabled="form.processing"
                        class="btn-md"
                    >
                        Register
                    </BreezeButton>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
