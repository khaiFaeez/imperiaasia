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
                    // errorBag: 'storeClient',
                    preserveScroll: true,
                     onFinish: () => {
                        this.showUpdateForm = false;
                        // this.$toast.success(this.$page.props.flash.message, {
                        //     position: 'top'
                        // });
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

<div >
     <h1 class="mb-8 text-2xl font-bold">
      <Link class="text-primary hover:text-primary-focus" href="/client">Client</Link>
      <span class="text-primary font-medium">/</span> Create
    </h1>


        <form @submit.prevent="storeClient" class="form">
            <div class="flex items-center justify-end mb-8">
                <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <i class="bi bi-save mr-3"></i>
                        Save
                </BreezeButton>
            </div>
            <ClientForm class=" mb-12"
                :client="form"
                :countries="$page.props.countries"
                :states="$page.props.states"/>
                <div>

            </div>




        </form>



</div>
</AppLayout>
</template>
