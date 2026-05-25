<script setup lang="ts">
import BaseBadge from "~/components/ui/BaseBadge.vue";

interface Props {
  eyebrow?: string
  title: string
  description?: string
  align?: 'left' | 'center'
}

withDefaults(defineProps<Props>(), {
  eyebrow: '',
  description: '',
  align: 'left',
})
</script>

<template>
  <div
    class="max-w-3xl"
    :class="{ 'mx-auto text-center': align === 'center' }"
  >
    <BaseBadge
      v-if="eyebrow"
      tone="secondary"
      class="mb-4"
    >
      {{ eyebrow }}
    </BaseBadge>
    <h2 class="text-3xl font-black tracking-tight text-ink sm:text-4xl">
      {{ title }}
    </h2>
    <p
      v-if="description"
      class="mt-4 text-lg leading-8 text-ink/60"
    >
      {{ description }}
    </p>
  </div>
</template>
