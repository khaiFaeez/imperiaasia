<script setup>
defineProps(['value'])
</script>

<template>
    <label class="label md:text-right font-bold text-base-content opacity-70">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
