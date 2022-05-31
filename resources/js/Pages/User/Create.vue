<script>
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import UserForm from '@/Components/Forms/UserForm.vue';
import BreezeButton from '@/Components/Button.vue'



export default {
    props:{
        status: String,
    },
    components:{
        AppLayout,
        Link,
        Head,
        UserForm,
        BreezeButton
    },
    data() {
        return {
            form: this.$inertia.form({
                username:"",
                name:"",
                staff_id:"",
                roles:[],
                portfolios:[],
                password:"",
                password_confirmation:"",
            }),
            // define options
            options: [ {
            id: '1',
            label: 'Platinum',
            children: [ {
                id: '11',
                label: 'Admin',
            }, {
                id: '12',
                label: 'Clerk',
            } ],
            }, {
            id: '2',
            label: 'Dresella',
            }, {
            id: '3',
            label: 'TCK',
            } ],
        }
    },
    methods: {
        storeUser() {
                this.form.post(route('users.store'),{
                    errorBag: 'storeUser',
                    preserveScroll: true,
                });
            },
    }
}

</script>

<template>
<Head title="Create User" />
<AppLayout>
            <h1 class="mb-8 text-2xl font-bold">
                <Link class="text-primary hover:text-primary-focus" href="/users">User</Link>
                <span class="text-primary font-medium">/</span> Create
            </h1>

            <div class="flex items-center justify-end my-3">
                <BreezeButton class="btn-sm" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </BreezeButton>
            </div>

        <form @submit.prevent="storeUser" class="form">
                <user-form :user="form" :options="options"></user-form>
        </form>
</AppLayout>

</template>
