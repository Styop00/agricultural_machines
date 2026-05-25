<script setup lang="ts">
export interface SelectOption {
  label: string
  value: string
}

interface Props {
  id: string
  label: string
  modelValue?: string
  options: SelectOption[]
  placeholder?: string
  required?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  modelValue: '',
  placeholder: 'Select an option',
  required: false,
})

const emit = defineEmits<{
  'update:modelValue': [value: string]
}>()

const isOpen = ref(false)
const root = ref<HTMLElement | null>(null)

const selectedOption = computed(() => props.options.find((option) => option.value === props.modelValue))

const selectOption = (value: string) => {
  emit('update:modelValue', value)
  isOpen.value = false
}

const closeOnOutsideClick = (event: MouseEvent) => {
  if (!root.value?.contains(event.target as Node)) {
    isOpen.value = false
  }
}

onMounted(() => document.addEventListener('mousedown', closeOnOutsideClick))
onBeforeUnmount(() => document.removeEventListener('mousedown', closeOnOutsideClick))
</script>

<template>
  <div
    ref="root"
    class="relative"
  >
    <label
      :id="`${id}-label`"
      :for="id"
      class="mb-2 block text-sm font-semibold text-ink/75"
    >
      {{ label }}
    </label>

    <button
      :id="id"
      type="button"
      class="flex w-full items-center justify-between gap-3 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-3 text-left text-ink outline-none transition hover:border-primary/35 hover:bg-white/[0.09] focus:border-primary focus:ring-4 focus:ring-primary/10"
      :aria-labelledby="`${id}-label ${id}`"
      :aria-expanded="isOpen"
      aria-haspopup="listbox"
      @click="isOpen = !isOpen"
      @keydown.escape.prevent="isOpen = false"
      @keydown.down.prevent="isOpen = true"
    >
      <span
        class="truncate"
        :class="selectedOption ? 'text-ink' : 'text-ink/40'"
      >
        {{ selectedOption?.label || placeholder }}
      </span>
      <span
        class="text-primary transition"
        :class="{ 'rotate-180': isOpen }"
        aria-hidden="true"
      >
        <svg
          class="size-4"
          viewBox="0 0 20 20"
          fill="none"
        >
          <path
            d="M5 7.5 10 12.5 15 7.5"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
          />
        </svg>
      </span>
    </button>

    <Transition
      enter-active-class="transition duration-150 ease-out"
      enter-from-class="-translate-y-1 opacity-0"
      enter-to-class="translate-y-0 opacity-100"
      leave-active-class="transition duration-100 ease-in"
      leave-from-class="translate-y-0 opacity-100"
      leave-to-class="-translate-y-1 opacity-0"
    >
      <div
        v-if="isOpen"
        class="absolute z-30 mt-2 max-h-72 w-full overflow-hidden rounded-2xl border border-primary/25 bg-slate-950/95 p-2 shadow-2xl shadow-black/50 ring-1 ring-white/10 backdrop-blur-xl"
      >
        <ul
          role="listbox"
          :aria-labelledby="`${id}-label`"
          class="max-h-60 overflow-y-auto pr-1"
        >
          <li>
            <button
              type="button"
              role="option"
              :aria-selected="modelValue === ''"
              class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-sm font-semibold text-ink/55 transition hover:bg-primary/10 hover:text-primary"
              @click="selectOption('')"
            >
              {{ placeholder }}
              <span
                v-if="modelValue === ''"
                class="text-primary"
              >●</span>
            </button>
          </li>
          <li
            v-for="option in options"
            :key="option.value"
          >
            <button
              type="button"
              role="option"
              :aria-selected="modelValue === option.value"
              class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-sm font-semibold transition"
              :class="modelValue === option.value ? 'bg-primary/15 text-primary' : 'text-ink/80 hover:bg-white/[0.06] hover:text-ink'"
              @click="selectOption(option.value)"
            >
              <span class="truncate">{{ option.label }}</span>
              <span
                v-if="modelValue === option.value"
                class="text-primary"
              >●</span>
            </button>
          </li>
        </ul>
      </div>
    </Transition>
  </div>
</template>
