<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps(['href', 'active'])

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5  focus:outline-none focus:border-indigo-700 transition  duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5  focus:outline-none transition duration-150 ease-in-out'
)
</script>

<template>
    <Link preserve-scroll :href="href" :class="classes">
        <slot />
    </Link>
</template>
