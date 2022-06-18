<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="btn btn-primary btn-sm text-primary-content ">
        <slot />
    </button>
</template>
