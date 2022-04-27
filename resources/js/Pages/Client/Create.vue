<script>
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import ClientForm from '@/Components/Forms/ClientForm.vue'


export default {
    props:[
        'client','states'
    ],
    components:{
        AppLayout,
        Link,
        Head,
        ClientForm,
    },
    data(){
        return {
            form:this.$inertia.form({
                    MyKad_SSM:"",
                    Name:"",
                    Mobile_No:"",
                    Phone:"",
                    Off_Phone:"",
                    Address:"",
                    Address_2:"",
                    Poscode:"",
                    City:"",
                    State:"",
                    Country:""
            })
        }
    }
}

</script>
<template>
<Head title="View Client" />
<AppLayout>
     <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/client">Client</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>

            <ClientForm  :client="form" :states="$page.props.states"/>

</AppLayout>
</template>
