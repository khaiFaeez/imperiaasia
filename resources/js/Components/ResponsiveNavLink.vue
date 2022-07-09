<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps(['href', 'active'])

const classes = computed(() => (props.active ? ' active' : ''))
</script>

<template>
    <Link :href="href" :class="classes" class="hover:bg-secondary">
        <slot />
    </Link>
</template>
