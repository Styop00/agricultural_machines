<script setup lang="ts">
import BaseBadge from "~/components/ui/BaseBadge.vue";
import BaseCard from "~/components/ui/BaseCard.vue";
import BaseButton from "~/components/ui/BaseButton.vue";
import ImageCarousel from "~/components/ui/ImageCarousel.vue";

const route = useRoute()
const { loadCar } = useStorefrontData()
const { data: car } = await loadCar(String(route.params.slug))

const title = computed(() => [
  car.value?.year,
  car.value?.manufacturer?.name,
  car.value?.model?.name,
].filter(Boolean).join(' '))

const price = computed(() => new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
  maximumFractionDigits: 0,
}).format(Number(car.value?.price || 0)))

useSeoMeta({
  title: () => `${title.value} | FieldPro Motor Gallery`,
  description: () => car.value?.description || 'Vehicle details and pricing.',
})
</script>

<template>
  <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div
      v-if="car"
      class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr]"
    >
      <BaseCard class="overflow-hidden p-0">
        <ImageCarousel
          :images="car.images || []"
          :alt="title"
          show-thumbnails
        />
      </BaseCard>

      <div>
        <BaseBadge tone="secondary">
          {{ car.stock }}
        </BaseBadge>
        <h1 class="mt-5 text-4xl font-black tracking-tight text-ink sm:text-5xl">
          {{ title }}
        </h1>
        <p class="mt-4 text-4xl font-black text-primary">
          {{ price }}
        </p>
        <p class="mt-6 text-lg leading-8 text-ink/62">
          {{ car.description }}
        </p>

        <BaseCard class="mt-8">
          <dl class="grid gap-5 sm:grid-cols-2">
            <div>
              <dt class="text-sm font-bold uppercase tracking-[0.18em] text-ink/45">
                Odometer
              </dt>
              <dd class="mt-1 text-xl font-black text-ink">
                {{ car.odometer?.toLocaleString() || 'N/A' }}
              </dd>
            </div>
            <div>
              <dt class="text-sm font-bold uppercase tracking-[0.18em] text-ink/45">
                Engine
              </dt>
              <dd class="mt-1 text-xl font-black text-ink">
                {{ car.engine || 'N/A' }}
              </dd>
            </div>
            <div>
              <dt class="text-sm font-bold uppercase tracking-[0.18em] text-ink/45">
                Manufacturer
              </dt>
              <dd class="mt-1 text-xl font-black text-ink">
                {{ car.manufacturer?.name }}
              </dd>
            </div>
            <div>
              <dt class="text-sm font-bold uppercase tracking-[0.18em] text-ink/45">
                Model
              </dt>
              <dd class="mt-1 text-xl font-black text-ink">
                {{ car.model?.name }}
              </dd>
            </div>
          </dl>
        </BaseCard>

        <div class="mt-8 flex gap-3">
          <BaseButton to="/contact">
            Contact About This Vehicle
          </BaseButton>
          <BaseButton
            to="/inventory"
            variant="ghost"
          >
            Back to Inventory
          </BaseButton>
        </div>
      </div>
    </div>
  </section>
</template>
