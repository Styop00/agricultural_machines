<script setup lang="ts">
defineOptions({
  inheritAttrs: false,
})

interface Props {
  id: string
  label: string
}

defineProps<Props>()
const attrs = useAttrs()

defineEmits<{
  change: [event: Event]
}>()
</script>

<template>
  <label
    :for="id"
    class="block"
  >
    <span class="mb-2 block text-sm font-semibold text-ink/75">{{ label }}</span>
    <input
      :id="id"
      v-bind="attrs"
      type="file"
      class="w-full rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-3 text-sm text-ink outline-none transition file:mr-4 file:rounded-full file:border-0 file:bg-primary file:px-4 file:py-2 file:text-sm file:font-bold file:text-slate-950 hover:border-primary/35 focus:border-primary focus:ring-4 focus:ring-primary/10"
      @change="$emit('change', $event)"
    >
  </label>
</template>
