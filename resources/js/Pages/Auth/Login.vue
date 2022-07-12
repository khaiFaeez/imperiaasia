<script setup>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'

defineProps({
    canResetPassword: Boolean,
    status: String
})

const form = useForm({
    username: '',
    password: '',
    remember: false
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password')
    })
}
</script>

<style>
.border-blob {
    border-radius: 48% 52% 100% 0% / 0% 100% 0% 100%;
}
</style>

<template>
    <div class="bg-secondary">
        <div
            class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-neutral max-w-3xl border-blob"
        >
            <div>
                <Link href="/">
                    <BreezeApplicationLogo
                        class="text-5xl text-neutral-content outline-primary"
                    />
                </Link>
            </div>

            <div
                class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-lg bg-base-200 overflow-hidden"
            >
                <Head title="Log in" />

                <BreezeValidationErrors class="mb-4" />

                <div v-if="status" class="mb-4 font-medium text-sm">
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <BreezeLabel for="username" value="Username" />
                        <BreezeInput
                            id="username"
                            type="text"
                            v-model="form.username"
                            required
                            autofocus
                            autocomplete="username"
                        />
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="password" value="Password" />
                        <BreezeInput
                            id="password"
                            type="password"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                        />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <BreezeCheckbox
                                name="remember"
                                v-model:checked="form.remember"
                            />
                            <span class="ml-2 text-sm">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <!-- <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm ">
                        Forgot your password?
                        </Link> -->

                        <BreezeButton
                            class="ml-4 btn-block btn-lg"
                            :class="{ loading: form.processing }"
                            :disabled="form.processing"
                        >
                            Log in
                        </BreezeButton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
