<template>
  <DefaultLayout>
    <Head title="Expenses Page" />
    <header class="bg-white shadow-sm">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">
          Welcome to your Expenses Page! {{ $page.props.auth.user.name }}
        </h1>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <!-- Button for expenses -->
          <div class="flex justify-end mb-4">
            <Link
              :href="route('addExpenses')"
              class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700"
            >
              Add Expenses
            </Link>
          </div>
                     <!-- Search funtion -->
          <div class="mt-4">
            <h2 class="text-xl font-bold ml-4">Search Filters</h2>
          </div>
          <div class="flex flex-wrap items-center gap-4 mt-4 ml-4">
          <!-- Date Filter -->
          <div class="flex flex-col">
            <label for="date-filter" class="block text-sm font-medium text-gray-700">Date</label>
            <input
              id="date-filter"
              v-model="searchFilters.dateOfExpenses"
              type="date"
              class="mt-1 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
            />
          </div>

          <!-- Source Filter -->
            <div class="flex flex-col">
              <label for="source-filter" class="block text-sm font-medium text-gray-700">Source</label>
              <input
                id="source-filter"
                v-model="searchFilters.sourceOfExpenses"
                type="text"
                placeholder="Search by source"
                class="mt-1 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
              />
            </div>

            <!-- Amount Filter -->
            <div class="flex flex-col">
              <label for="amount-filter" class="block text-sm font-medium text-gray-700">Amount</label>
              <input
                id="amount-filter"
                v-model="searchFilters.amountOfExpenses"
                type="number"
                placeholder="Search by amount"
                class="mt-1 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
              />
            </div>

            <!-- Reset Button -->
            <div class="flex flex-col">
              <button
                @click="resetFilters"
                type="button"
                class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 mt-5"
              >
                Reset
              </button>
            </div>
          </div>


          <!-- Total Expenses Section -->
          <div class="mt-4">
            <h2 class="text-xl font-bold">Total Expenses: ₱{{ totalExpenses }}</h2>
          </div>

          <!-- Table -->
          <div v-if="expenses.data.length > 0">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="px-6 py-3">Date</th>
                  <th scope="col" class="px-6 py-3">Source</th>
                  <th scope="col" class="px-6 py-3">Description</th>
                  <th scope="col" class="px-6 py-3">Amount</th>
                  <th scope="col" class="px-6 py-3">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
                  v-for="(expense, index) in expenses.data"
                  :key="index"
                >
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ expense.dateOfExpenses }}
                  </th>
                  <td class="px-6 py-4">{{ expense.sourceOfExpenses }}</td>
                  <td class="px-6 py-4">{{ expense.descriptionOfExpenses }}</td>
                  <td class="px-6 py-4">{{ expense.amountOfExpenses }}</td>
                  <td class="px-6 py-4">
                    <Link
                      :href="route('editExpenses', expense.id)"
                      class="font-medium text-green-600 dark:text-blue-500 hover:underline mr-5"
                    >
                      Edit
                    </Link>
                    <button
                      @click="deleteExpense(expense.id)"
                      class="font-medium text-red-600 dark:text-blue-500 hover:underline"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Empty State -->
          <div v-else class="text-center py-6 text-gray-500">
            <p>No expenses available.</p>
          </div>
        </div>
        <!-- Pagination -->
        <div v-if="expenses.links" class="mt-4">
            <ul class="flex items-center justify-center space-x-2">
              <li v-for="link in expenses.links" :key="link.label">
                <a
                  :href="link.url"
                  v-html="link.label"
                  :class="[ 
                    'px-3 py-2 border rounded-lg',
                    { 'text-gray-500 cursor-not-allowed': !link.url, 'text-blue-500 hover:bg-blue-100': link.url, 'font-bold underline': link.active }
                  ]"
                ></a>
              </li>
            </ul>
          </div>
      </div>
    </main>
  </DefaultLayout>
</template>

<script setup>
import { Head, Link  } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import Swal from 'sweetalert2';
import toastr from 'toastr';
import { ref, watch } from 'vue';
import { debounce } from 'lodash';
import { router } from '@inertiajs/vue3';
import 'toastr/build/toastr.min.css';

// Define props
const props = defineProps({
  expenses: {
    type: Object,
    required: true,
  },
  totalExpenses: {
    type: Number,
    required: true,
  },
});

// Search filters
const searchFilters = ref({
  dateOfExpenses: '',
  sourceOfExpenses: '',
  amountOfExpenses: '',
});

// Watch for changes in filters and debounce the request
watch(
  searchFilters,
  debounce(() => {
    router.get(
      route('expenses'),
      { ...searchFilters.value }, // Pass filters as query params
      { preserveState: true }
    );
  }, 500),
  { deep: true }
);

// Reset filters
const resetFilters = () => {
  searchFilters.value = {
    dateOfExpenses: '',
    sourceOfExpenses: '',
    amountOfExpenses: '',
  };
  router.get(route('expenses'), {}, { preserveState: true }); // Clear filters and reload data
};

// Delete expense
const deleteExpense = (id) => {
  Swal.fire({
    title: 'Are you sure?',
    text: 'You won’t be able to revert this!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'Cancel',
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(route('deleteExpense', id), {
        onSuccess: () => {
          toastr.success('Expense record deleted successfully!');
        },
        onError: () => {
          toastr.error('Something went wrong. Please double-check your entry.');
        },
      });
    }
  });
};
</script>
