<template>
    <div>
        <ul class="tabs">
            <li
                v-for="title in tabTitles"
                :key="title"
                @click="selectedTitle = title"
                :class="{ ' tab-active': title == selectedTitle }"
                class="tab tab-lifted font-bold"
            >
                {{ title }}
            </li>
        </ul>
        <slot />
    </div>
</template>

<script>
import { ref, provide } from 'vue'

export default {
    setup(props, { slots }) {
        const tabTitles = ref(slots.default().map((tab) => tab.props.title))
        const selectedTitle = ref(tabTitles.value[0])

        provide('selectedTitle', selectedTitle)
        return {
            selectedTitle,
            tabTitles
        }
    }
}
</script>
