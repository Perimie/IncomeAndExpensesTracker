<template>
  <DefaultLayout>
      <Head title="Expenses Page"/>
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
                      <Link :href="route('addExpenses')" 
                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700">
                          Add Expenses
                      </Link>
                  </div>
                  
                  <!-- Total Expenses Section -->
                  <div class="mt-4">
                      <h2 class="text-xl font-bold">Total Expenses: ₱{{ totalAmount }}</h2>
                  </div>

                  <!-- Table or Empty State -->
                  <div v-if="expenses.length > 0">
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
                              <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
                                  v-for="(expense, index) in expenses"
                                  :key="index">
                                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      {{ expense.dateOfExpenses }}
                                  </th>
                                  <td class="px-6 py-4">{{ expense.sourceOfExpenses }}</td>
                                  <td class="px-6 py-4">{{ expense.descriptionOfExpenses }}</td>
                                  <td class="px-6 py-4">{{ expense.amountOfExpenses }}</td>
                                  <td class="px-6 py-4">
                                      <Link :href="route('editExpenses', expense.id)" 
                                            class="font-medium text-green-600 dark:text-blue-500 hover:underline mr-5">
                                          Edit
                                      </Link>
                                      <button @click="deleteExpense(expense.id)" 
                                              class="font-medium text-red-600 dark:text-blue-500 hover:underline">
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
          </div>
      </main>
  </DefaultLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'; 
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';
import Swal from 'sweetalert2';

// Define props
const props = defineProps({
expenses: {
  type: Array,
  required: true,
},
});

// Compute total expenses amount
const totalAmount = computed(() => {
return props.expenses.reduce((sum, expense) => sum + expense.amountOfExpenses, 0);
});

toastr.options = {
"timeOut": "5000",
"extendedTimeOut": "1000",
"positionClass": "toast-top-right",
"closeButton": true,
"progressBar": true,
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
        toastr.error('Something went wrong. Please Double Check your entry.');
      },
    });
  }
});
};
</script>
