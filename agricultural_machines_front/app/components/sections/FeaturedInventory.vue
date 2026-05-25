<script setup lang="ts">
import type { Car } from '~/types/api'
import SectionHeader from "~/components/ui/SectionHeader.vue";
import BaseButton from "~/components/ui/BaseButton.vue";
import MachineCard from "~/components/inventory/MachineCard.vue";
import EmptyState from "~/components/ui/EmptyState.vue";

interface Props {
  cars: Car[]
}

defineProps<Props>()
</script>

<template>
  <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mb-10 flex flex-col justify-between gap-6 md:flex-row md:items-end">
      <SectionHeader
        eyebrow="Featured Inventory"
        title="Machines that look ready to work."
        description="A polished overview of current listings with price, condition signals, engine details, categories, and buyer-focused calls to action."
      />
      <BaseButton
        to="/inventory"
        variant="ghost"
      >
        View All Inventory
      </BaseButton>
    </div>

    <div
      v-if="cars.length"
      class="grid gap-6 md:grid-cols-2 lg:grid-cols-3"
    >
      <MachineCard
        v-for="car in cars"
        :key="car.id"
        :car="car"
      />
    </div>

    <EmptyState
      v-else
      title="No inventory yet"
      description="Add vehicle listings in the backend and they will appear here automatically."
    />
  </section>
</template>
