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
    <div class="max-w-7xl">
            <h1 class="mb-8 text-2xl font-bold flex gap-2 items-center">
                <Link class="text-primary hover:text-primary-focus" href="/users">User</Link>
                <span class="text-primary font-medium">/</span> Edit
            </h1>




        <form @submit.prevent="updateUser($page.props.user.id)" class="form mb-12">
            <user-form :user="form" :options="options" ></user-form>

              <div class="flex items-center justify-end my-12">
                <button class="btn btn-ghost mr-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                <i class="bi bi-trash3 mr-3"></i>
                    Delete
                </button>

                <BreezeButton  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                <i class="bi bi-save mr-3"></i>
                    Save
                </BreezeButton>




            </div>
        </form>

    </div>
</AppLayout>
</template>
