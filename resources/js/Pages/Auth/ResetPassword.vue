<script setup>
import BreezeButton from '@/Components/Button.vue'
import AppLayout from '@/Layouts/Authenticated.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, useForm, Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
    username: String
})

const form = useForm({
    username: props.username,
    password: '',
    password_confirmation: ''
})

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation')
    })
}
</script>

<template>
    <AppLayout>
        <Head title="Reset Password" />

        <BreezeValidationErrors class="mb-4" />
        <h1 class="mb-8 text-2xl font-bold flex gap-2 items-center">
            <Link
                class="text-primary hover:text-primary-focus"
                :href="route('users.index')"
                >User</Link
            >
            <span class="text-primary font-medium">/</span> Reset Password
        </h1>
        <form
            @submit.prevent="submit"
            class="p-4 bg-white rounded-xl max-w-5xl"
        >
            <div>
                <BreezeLabel for="username" value="Username" />
                <p class="mt-1 block w-full">{{ form.username }}</p>
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />
            </div>

            <div class="mt-4">
                <BreezeLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />
                <BreezeInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <BreezeButton
                    :class="{ loading: form.processing }"
                    :disabled="form.processing"
                >
                    Reset Password
                </BreezeButton>
            </div>
        </form>
    </AppLayout>
</template>
