<template>
    <div v-show="title == selectedTitle">
        <slot />
    </div>
</template>

<script>
import { inject } from 'vue'
export default {
    props: {
        title: {
            type: String,
            default: 'Tab'
        }
    },
    setup() {
        const selectedTitle = inject('selectedTitle')

        return {
            selectedTitle
        }
    }
}
</script>
