<script>
import AppLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Bar, Pie } from 'vue-chartjs'

import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
    ArcElement
} from 'chart.js'

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
    ArcElement
)

export default {
    components: {
        AppLayout,
        Head,
        Bar,
        Pie,
        Link
    },

    props: {
        chartId: {
            type: String,
            default: 'bar-chart'
        },
        pieId: {
            type: String,
            default: 'pie-chart'
        },
        datasetIdKey: {
            type: String,
            default: 'label'
        },
        width: {
            type: Number,
            default: 400
        },
        height: {
            type: Number,
            default: 400
        },
        cssClasses: {
            default: '',
            type: String
        },
        styles: {
            type: Object,
            default: () => {
                'bg-accent'
            }
        },
        plugins: {
            type: Object,
            default: () => {}
        }
    },
    data() {
        return {
            chartData: {
                labels: this.$page.props.bottles.days,
                datasets: [
                    {
                        label: 'Last 7 Days Bottle',
                        backgroundColor: 'rgb(215, 80, 80)',
                        data: this.$page.props.bottles.total
                    }
                ]
            },
            pieData: {
                labels: ['Platinum', 'Dresella', 'Maryam'],
                datasets: [
                    {
                        backgroundColor: ['#41B883', '#E46651', '#00D8FF'],
                        data: [40, 20, 80]
                    }
                ]
            },
            chartOptions: {
                responsive: true
            }
        }
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold leading-tight">Dashboard</h2>
        </template>

        <h1 class="mb-8 text-2xl font-bold flex gap-2 items-center">
            <Link class="text-primary hover:text-primary-focus" href="/print"
                >Dashboard</Link
            >
        </h1>
        <div class="max-w-7xl">
            <div
                class="stats stats-vertical lg:stats-horizontal shadow w-full border-2 border-success"
            >
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            class="inline-block w-8 h-8 stroke-current"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                            ></path>
                        </svg>
                    </div>
                    <div class="stat-title">Client</div>
                    <div class="stat-value text-primary">
                        {{ $page.props.clients.toLocaleString() }}
                    </div>
                    <div class="stat-desc">21% more than last month</div>
                </div>

                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            class="inline-block w-8 h-8 stroke-current"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"
                            ></path>
                        </svg>
                    </div>
                    <div class="stat-title">Invoices</div>
                    <div class="stat-value text-secondary">
                        {{ $page.props.total_invoice.toLocaleString() }}
                    </div>
                    <div class="stat-desc">
                        Performing 21% more than last month
                    </div>
                </div>

                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <div class="avatar online">
                            <div class="w-16 rounded-full">
                                <img
                                    src="https://api.lorem.space/image/face?w=128&h=128"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="stat-value">{{ $page.props.users }}</div>
                    <div class="stat-title">Users</div>
                    <div class="stat-desc text-secondary">Active</div>
                </div>

                <div class="stat">
                    <div class="stat-title">Portfolio</div>
                    <div class="stat-value">{{ $page.props.portfolios }}</div>
                    <div class="stat-desc">actives</div>
                </div>
            </div>
        </div>

        <div class="my-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                <Bar
                    :chart-options="chartOptions"
                    :chart-data="chartData"
                    :chart-id="chartId"
                    :dataset-id-key="datasetIdKey"
                    :plugins="plugins"
                    :css-classes="cssClasses"
                    :styles="styles"
                    :width="width"
                    :height="height"
                />

                <!-- <Pie :chart-options="chartOptions" :chart-data="pieData" :width="width" :height="height"
                    :chart-id="pieId" /> -->
            </div>
        </div>
    </AppLayout>
</template>
