<script setup lang="ts">
import BaseCard from "~/components/ui/BaseCard.vue";
import BrandIcon from "~/components/ui/BrandIcon.vue";

interface Props {
  title: string
  description?: string
}

defineProps<Props>()
</script>

<template>
  <BaseCard class="text-center">
    <div class="mx-auto mb-4 flex size-16 items-center justify-center rounded-2xl border border-primary/25 bg-primary/10 p-4 text-primary">
      <BrandIcon name="roadster" />
    </div>
    <h3 class="text-xl font-black text-ink">
      {{ title }}
    </h3>
    <p
      v-if="description"
      class="mt-2 text-ink/60"
    >
      {{ description }}
    </p>
  </BaseCard>
</template>
