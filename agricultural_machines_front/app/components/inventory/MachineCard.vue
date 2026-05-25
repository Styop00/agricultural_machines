<script setup lang="ts">
import type { Car } from '~/types/api'
import BaseCard from "~/components/ui/BaseCard.vue";
import BaseBadge from "~/components/ui/BaseBadge.vue";
import BaseButton from "~/components/ui/BaseButton.vue";
import BrandIcon from "~/components/ui/BrandIcon.vue";
import ImageCarousel from "~/components/ui/ImageCarousel.vue";

interface Props {
  car: Car
}

const props = defineProps<Props>()

const title = computed(() => [
  props.car.year,
  props.car.manufacturer?.name,
  props.car.model?.name,
].filter(Boolean).join(' '))

const price = computed(() => new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
  maximumFractionDigits: 0,
}).format(Number(props.car.price)))

</script>

<template>
  <BaseCard class="group flex h-full flex-col overflow-hidden p-0 transition duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-primary/10">
    <div class="relative overflow-hidden">
      <ImageCarousel
        :images="car.images || []"
        :alt="title"
      />
      <BaseBadge class="absolute left-5 top-5">
        {{ car.stock }}
      </BaseBadge>
    </div>

    <div class="flex flex-1 flex-col p-6">
      <h3 class="text-xl font-black text-ink">
        {{ title }}
      </h3>
      <div class="mt-4 grid grid-cols-2 gap-3 text-sm text-ink/62">
        <span class="flex items-center gap-2">
          <span class="size-5 text-primary"><BrandIcon name="gauge" /></span>
          <span><strong class="text-ink">{{ car.odometer?.toLocaleString() || 'N/A' }}</strong> miles</span>
        </span>
        <span class="flex items-center gap-2">
          <span class="size-5 text-secondary"><BrandIcon name="engine" /></span>
          <strong class="text-ink">{{ car.engine || 'N/A' }}</strong>
        </span>
      </div>
      <p
        v-if="car.description"
        class="mt-4 line-clamp-3 text-sm leading-6 text-ink/58"
      >
        {{ car.description }}
      </p>
      <div class="mt-auto flex items-center justify-between gap-4 pt-6">
        <span class="text-2xl font-black text-primary">{{ price }}</span>
        <BaseButton
          :to="`/inventory/${car.slug}`"
          variant="ghost"
          size="sm"
        >
          More Info
        </BaseButton>
      </div>
    </div>
  </BaseCard>
</template>
