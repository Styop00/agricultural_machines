<script setup lang="ts">
import BaseCard from "~/components/ui/BaseCard.vue";
import BaseBadge from "~/components/ui/BaseBadge.vue";
import BrandIcon from "~/components/ui/BrandIcon.vue";

interface Props {
  eyebrow: string
  title: string
  description: string
}

defineProps<Props>()
</script>

<template>
  <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <BaseCard class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-primary-900 to-slate-900 p-10 text-white sm:p-14">
      <div class="absolute -right-12 -top-16 size-56 rounded-full bg-primary/20 blur-3xl" />
      <div class="absolute bottom-8 right-10 hidden size-28 text-primary/25 md:block">
        <BrandIcon name="roadster" />
      </div>
      <BaseBadge tone="secondary">
        {{ eyebrow }}
      </BaseBadge>
      <h1 class="mt-6 max-w-4xl text-4xl font-black tracking-tight sm:text-6xl">
        {{ title }}
      </h1>
      <p class="mt-5 max-w-3xl text-lg leading-8 text-white/75">
        {{ description }}
      </p>
    </BaseCard>
  </section>
</template>
