<script setup lang="ts">
interface Props {
  tone?: 'primary' | 'secondary' | 'neutral'
}

withDefaults(defineProps<Props>(), {
  tone: 'primary',
})
</script>

<template>
  <span
    class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.18em]"
    :class="{
      'border border-primary/25 bg-primary/10 text-primary': tone === 'primary',
      'border border-secondary/30 bg-secondary/15 text-secondary-100': tone === 'secondary',
      'border border-white/10 bg-white/[0.06] text-ink/70': tone === 'neutral',
    }"
  >
    <slot />
  </span>
</template>
