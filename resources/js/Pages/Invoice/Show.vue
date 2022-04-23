<script>
import { ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination'

const showingNavigationDropdown = ref(false);


export default {
    components:{
        Pagination,
        AppLayout
    },
    methods: {
        goToViewPage(data) {
            window.open(route('portfolio.invoice.show',{'invoice': data.Id,'portfolio':this.$page.props.portfolio}), '_self');
        }
    }
}

</script>

<template>

<AppLayout>
    {{$page.props.invoice}}
</AppLayout>

</template>
