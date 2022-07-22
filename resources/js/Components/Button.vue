<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit'
    }
})
</script>

<template>
    <button :type="type" class="btn btn-neutral btn-sm text-neutral-content">
        <slot />
    </button>
</template>
