<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
    <Link
        preserve-scroll
        class="block w-full px-4 py-2 text-left text-sm leading-5 hover:bg-base-200 focus:outline-none focus:bg-base-200 transition duration-150 ease-in-out"
    >
        <slot />
    </Link>
</template>
