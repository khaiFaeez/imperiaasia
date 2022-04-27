<script>
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import ClientDisplay from '@/Components/Forms/ClientDisplay.vue'


export default {
    props:[
        'client','states'
    ],
    components:{
        AppLayout,
        Link,
        Head,
        ClientDisplay,
    },
}

</script>
<template>
<Head title="View Client" />
<AppLayout>
     <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/client">Client</Link>
      <span class="text-indigo-400 font-medium">/</span> {{client.Name}}
    </h1>

            <ClientDisplay  :client="client" :states="$page.props.states"/>

</AppLayout>

</template>
