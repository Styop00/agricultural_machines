<script setup lang="ts">
import SectionHeader from "~/components/ui/SectionHeader.vue";

const appConfig = useAppConfig()
</script>

<template>
  <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
      <SectionHeader
        eyebrow="Premium Equipment Buying"
        :title="`${appConfig.shop.name} in Green Bay, WI`"
        description="A focused machinery buying experience for operators who want confidence before they ever call."
      />
      <div class="space-y-5 text-lg leading-8 text-ink/62">
        <p>
          Whether you are looking for a dependable tractor, a high-capacity combine, or a specialized implement, the catalog is designed to make evaluation simple and quick.
        </p>
        <p>
          Every listing can include manufacturer, model, year, stock number, hours or odometer, engine, price, categories, images, and a clear description from the backend.
        </p>
        <p>
          The dark visual system keeps attention on the equipment: glass cards, custom icons, deep backgrounds, and sharp contrast create a stronger buying mood.
        </p>
      </div>
    </div>
  </section>
</template>
