<script setup lang="ts">
defineOptions({
  inheritAttrs: false,
})

interface Props {
  id: string
  label: string
  modelValue?: string
  type?: string
  placeholder?: string
}

withDefaults(defineProps<Props>(), {
  modelValue: '',
  type: 'text',
  placeholder: '',
})

defineEmits<{
  'update:modelValue': [value: string]
}>()

const attrs = useAttrs()
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
      :value="modelValue"
      :type="type"
      :placeholder="placeholder"
      class="w-full rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-3 text-ink outline-none transition placeholder:text-ink/35 focus:border-primary focus:ring-4 focus:ring-primary/10"
      @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
    >
  </label>
</template>
