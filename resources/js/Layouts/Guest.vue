<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-neutral"
    >
        <div>
            <Link href="/">
                <BreezeApplicationLogo
                    class="text-5xl text-neutral-content outline-primary"
                />
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-lg bg-base-200 overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
