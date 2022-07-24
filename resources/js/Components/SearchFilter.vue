<template>
    <div class="flex items-center">
        <div class="flex w-full bg-white rounded shadow">
            <input
                class="input w-full bg-white input-bordered"
                autocomplete="off"
                type="text"
                name="search"
                placeholder="Search"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
            />
        </div>
        <button
            class="ml-3 focus:text-indigo-500 text-sm"
            type="button"
            @click="$emit('reset')"
        >
            Reset
        </button>
    </div>
</template>

<script>
export default {
    components: {},
    props: {
        modelValue: String,
        maxWidth: {
            type: Number,
            default: 300
        }
    },
    emits: ['update:modelValue', 'reset']
}
</script>
