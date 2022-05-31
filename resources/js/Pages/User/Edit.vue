<script>
import { ref } from 'vue';
import { Link, Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination'
import moment from 'moment'
import BreezeButton from '@/Components/Button.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from  '@/Components/InputError.vue'
import UserForm from '@/Components/Forms/UserForm.vue';

const showingNavigationDropdown = ref(false);


export default {
    props:{
        status: String,
    },
    components:{
        Pagination,
        AppLayout,
        BreezeLabel,
        BreezeButton,
        BreezeInput,
        BreezeInputError,
        Link,
        Head,
        UserForm,
    },
    data() {
        return {
            form: this.$inertia.form({
                 _method: 'PUT',
                id:this.$page.props.user.id,
                username:this.$page.props.user.username,
                name:this.$page.props.user.name,
                staff_id:this.$page.props.user.staff_id,
                roles:Object.values(this.$page.props.userRole),
                portfolios:Object.values(this.$page.props.userPortfolio)
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
        updateUser(id) {

                this.form.post(route('users.update',{"user":id}),{
                    errorBag: 'updateMembershipInformation',
                    preserveScroll: true,
                });
            },
    }
}

</script>

<template>
<Head title="Edit User" />
<AppLayout>
            <h1 class="mb-8 text-2xl font-bold">
                <Link class="text-primary hover:text-primary-focus" href="/users">User</Link>
                <span class="text-primary font-medium">/</span> Edit
            </h1>

            <div class="flex items-center justify-end my-3">
                <BreezeButton class="ml-4 btn-sm" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save mr-3" viewBox="0 0 16 16">
                 <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                </svg>
                    Save
                </BreezeButton>
            </div>


        <form @submit.prevent="updateUser($page.props.user.id)" class="form">
            <user-form :user="form" :options="options" ></user-form>
        </form>
</AppLayout>
</template>
