<script setup lang="ts">
import BaseCard from "~/components/ui/BaseCard.vue";
import BaseBadge from "~/components/ui/BaseBadge.vue";
import BrandIcon from "~/components/ui/BrandIcon.vue";

const features = [
  {
    icon: 'roadster',
    title: 'Field-Ready Inventory',
    description: 'Explore tractors, combines, implements, and work-ready machines with sharp photos, clear pricing, and inspection-first details.',
    to: '/inventory',
  },
  {
    icon: 'carrier',
    title: 'Nationwide Delivery',
    description: 'Coordinate secure heavy-equipment transport with careful pickup, routing, and handoff from our yard to your operation.',
    to: '/nationwide-delivery',
  },
  {
    icon: 'shield',
    title: 'Buyer Confidence',
    description: 'Shop with transparent terms, verified machine condition, and a team that stands behind every listing.',
    to: '/money-back-guarantee',
  },
] as const
</script>

<template>
  <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="grid gap-5 md:grid-cols-3">
      <BaseCard
        v-for="feature in features"
        :key="feature.title"
        class="group relative overflow-hidden"
      >
        <div class="absolute -right-10 -top-10 size-32 rounded-full bg-primary/10 blur-2xl transition group-hover:bg-primary/20" />
        <div class="flex size-16 items-center justify-center rounded-2xl border border-primary/25 bg-primary/10 p-4 text-primary">
          <BrandIcon :name="feature.icon" />
        </div>
        <BaseBadge
          tone="primary"
          class="mt-5"
        >
          Designed path
        </BaseBadge>
        <h3 class="mt-5 text-2xl font-black text-ink">
          {{ feature.title }}
        </h3>
        <p class="mt-3 min-h-24 text-ink/58">
          {{ feature.description }}
        </p>
        <NuxtLink
          :to="feature.to"
          class="mt-6 inline-flex font-black text-primary transition group-hover:translate-x-1"
        >
          Learn more →
        </NuxtLink>
      </BaseCard>
    </div>
  </section>
</template>
