<script>
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import ClientForm from '@/Components/Forms/ClientForm.vue'
import BreezeButton from '@/Components/Button'


export default {
    props:[
        'client','states'
    ],
    components:{
        AppLayout,
        Link,
        Head,
        ClientForm,
        BreezeButton
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
    },
    methods: {
        storeClient() {
                this.form.post(route('portfolio.client.store'),{
                    errorBag: 'storeClient',
                    preserveScroll: true,
                     onFinish: () => {
                        this.showUpdateForm = false;
                        this.$toast.success(this.$page.props.flash.message, {
                            position: 'top'
                        });
                    },
                });
            },
             goToViewPage(data) {
            window.open(route('portfolio.invoice.show',{'invoice': data.Id}), '_self');
        },
    }
}

</script>
<template>
<Head title="View Client" />
<AppLayout>
     <h1 class="mb-8 text-2xl font-bold">
      <Link class="text-primary hover:text-primary-focus" href="/client">Client</Link>
      <span class="text-primary font-medium">/</span> Create
    </h1>


        <form @submit.prevent="storeClient" class="form">
            <ClientForm
                :client="form"
                :countries="$page.props.countries"
                :states="$page.props.states"/>
                <div>
            <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save mr-3" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
</svg>
                Save
            </BreezeButton>
            </div>
        </form>

</AppLayout>
</template>
