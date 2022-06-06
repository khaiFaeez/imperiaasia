<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Bar } from 'vue-chartjs'


import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)


export default {
  name: 'BarChart',
  components: {
      BreezeAuthenticatedLayout,
      Head,
      Bar
      },
  props: {
    chartId: {
      type: String,
      default: 'bar-chart'
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
          'bg-base-300'
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
        labels: [ 'January', 'February', 'March' ],
        datasets: [ { data: [40, 20, 12] } ]
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

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="my-12 p-3 bg-base-300">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="stats stats-vertical lg:stats-horizontal w-full shadow-xl">

            <div class="stat">
                <div class="stat-title">Invoices</div>
                <div class="stat-value">{{ $page.props.total_invoice.toLocaleString() }}</div>
                <div class="stat-desc"></div>
            </div>

            <div class="stat">
                <div class="stat-title">Users</div>
                <div class="stat-value">{{ $page.props.users.toLocaleString() }}</div>
                <div class="stat-desc"></div>
            </div>

            <div class="stat">
                <div class="stat-title">Portfolios</div>
                <div class="stat-value">{{ $page.props.portfolios }}</div>
                <div class="stat-desc"></div>
            </div>

            <div class="stat">
                <div class="stat-title">Clients</div>
                <div class="stat-value">{{ $page.props.clients.toLocaleString() }}</div>
                <div class="stat-desc"></div>
            </div>
            </div>

            </div>
        </div>

        <div class="my-12 ">
            <div class="grid grid-cols-3">
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
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
