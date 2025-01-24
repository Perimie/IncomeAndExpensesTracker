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
      </main>
    </DefaultLayout>
    
  </template>
  <script setup>
  import { Head } from '@inertiajs/vue3';
  import DefaultLayout from '@/Layouts/DefaultLayout.vue';
    </script>
  
  