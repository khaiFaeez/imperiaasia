<script setup>
import { computed, ref, watch } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const show = ref(usePage().props.value.flash?.message ? true : false);
const style = computed(() => usePage().props.value.flash?.bannerStyle || 'success');
const message = computed(() => usePage().props.value.flash?.message || '');

watch(message, async () => {
    show.value = true;
});


setTimeout(() => show.value = false, 4000);

const closeBox = () => {
    show.value = false;
}
</script>

<template>
    <div>
        <transition leave-active-class="transition ease-in duration-1000" leave-from-class="opacity-100"
            leave-to-class="opacity-0">

            <div v-show="show" class="text-sm text-red-600  absolute top-20 right-5 max-w-xl z-20">
                <div class="alert text-white" :class="`alert-${style}`">
                    <p>{{ $page.props.flash.message }}</p>
                    <span @click="closeBox" class="hover:cursor-pointer">X</span>
                </div>
            </div>
        </transition>
    </div>
</template>

<style>
/* we will explain what these classes do next! */
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
