<script setup>
import Navbar from '@/Components/Navbar.vue';

</script>

<template>
    <div>
        <Navbar/>

        <!-- this is the content from other pages -->
        <slot/>
    </div>
   

</template>