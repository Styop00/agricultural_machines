<script setup lang="ts">
import SiteHeader from "~/components/layout/SiteHeader.vue";
import SiteFooter from "~/components/layout/SiteFooter.vue";

const { loadCompany } = useStorefrontData()
const { data: company } = await loadCompany()
</script>

<template>
  <div class="relative min-h-screen overflow-hidden">
    <div class="pointer-events-none absolute left-0 top-24 h-80 w-80 rounded-full bg-primary/10 blur-[120px]" />
    <div class="pointer-events-none absolute bottom-96 right-0 h-96 w-96 rounded-full bg-secondary/10 blur-[140px]" />
    <SiteHeader />
    <main class="relative">
      <slot />
    </main>
    <SiteFooter :company="company" />
  </div>
</template>
