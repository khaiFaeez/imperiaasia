<script>
import { Link, Head } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/Authenticated.vue'
import ClientForm from '@/Components/Forms/ClientForm.vue'
import BreezeButton from '@/Components/Button'

export default {
    props: ['client', 'states'],
    components: {
        AppLayout,
        Link,
        Head,
        ClientForm,
        BreezeButton
    },
    data() {
        return {
            form: this.$inertia.form({
                id: this.client.id,
                MyKad_SSM: this.client.MyKad_SSM,
                Name: this.client.Name,
                Mobile_No: this.client.Mobile_No,
                Phone: this.client.Phone,
                Off_Phone: this.client.Off_Phone,
                Address: this.client.Address,
                Address_2: this.client.Address_2,
                Poscode: this.client.Poscode,
                City: this.client.City,
                State: this.client.State,
                Country: this.client.Country
            })
        }
    },
    methods: {
        storeClient() {
            this.form.put(
                route('portfolio.client.update', { client: this.client.id }),
                {
                    preserveScroll: true,
                    onFinish: () => {
                        this.showUpdateForm = false
                        // this.$toast.success(this.$page.props.flash.message, {
                        //     position: 'top'
                        // });
                    }
                }
            )
        }
    }
}
</script>
<template>
    <Head title="Edit Client" />
    <AppLayout>
        <div>
            <h1 class="mb-8 text-2xl font-bold flex gap-2 items-center">
                <Link
                    class="text-primary hover:text-primary-focus"
                    href="/client"
                    >Client</Link
                >
                <span class="text-primary font-medium">/</span> Edit
            </h1>

            <form @submit.prevent="storeClient" class="form">
                <div class="menu menu-horizontal w-full justify-end mb-4">
                    <Link
                        :href="
                            route('portfolio.client.show', {
                                client: client.id
                            })
                        "
                        class="btn btn-ghost btn-sm"
                    >
                        Discard
                    </Link>
                    <BreezeButton
                        :class="{ 'loading mr-2': form.processing }"
                        :disabled="form.processing"
                    >
                        Save
                    </BreezeButton>
                </div>
                <ClientForm
                    class="mb-12"
                    :client="form"
                    :countries="$page.props.countries"
                    :states="$page.props.states"
                />
                <div></div>
            </form>
        </div>
    </AppLayout>
</template>
