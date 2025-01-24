<template>

<DefaultLayout>
    <Head title="Dashboard"/>
      <header class="bg-white shadow-sm">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <h1 class="text-3xl font-bold tracking-tight text-gray-900">Welcome to your Dashboard! {{ $page.props.auth.user.name }}</h1>
        </div>
      </header>
      <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <h1 class="text-xl font-bold tracking-tight text-gray-900">This is summary of your Income, Expenses and Revenue</h1>
          
        </div>
          <!-- Card -->
        <div class="flex justify-center">
                
          <div class="max-w-sm w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
            <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
              <dl>
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Revenue</dt>
                <dd class="leading-none text-3xl font-bold text-gray-900 dark:text-white">₱{{ $page.props.revenue  }}</dd>
              </dl>
              <div>
                <span class="bg-gray-300 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-gray-900 dark:text-green-300">
                  
                  Revenue rate is {{ $page.props.profitRate}}%
                </span>
              </div>
            </div>

            <div class="grid grid-cols-2 py-3">
              <dl>
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Income</dt>
                <dd class="leading-none text-xl font-bold text-green-500 dark:text-green-400">₱{{ $page.props.income }}</dd>
              </dl>
              <dl>
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Expense</dt>
                <dd class="leading-none text-xl font-bold text-red-600 dark:text-red-500">-₱{{ $page.props.expenses }}</dd>
              </dl>
            </div>
              <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                  <!-- Button -->
                  <button
                    id="dropdownDefaultButton"
                    data-dropdown-toggle="lastDaysdropdown"
                    data-dropdown-placement="bottom"
                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                    type="button">
                    Last 6 months
                    <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                  </button>
                  <!-- Dropdown menu -->
                  <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 6 months</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last year</a>
                        </li>
                      </ul>
                  </div>
                  <a
                    href="#"
                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                    Revenue Report
                    <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                  </a>
                </div>
              </div>
          </div>
            

        </div>
      </main>
    </DefaultLayout>
    
  </template>
  <script setup>
  import { Head } from '@inertiajs/vue3';
  import DefaultLayout from '@/Layouts/DefaultLayout.vue';
  
  
    </script>
  
  