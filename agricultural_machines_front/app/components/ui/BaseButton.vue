<script setup lang="ts">
defineOptions({
  inheritAttrs: false,
})

interface Props {
  to?: string
  href?: string
  type?: 'button' | 'submit' | 'reset'
  variant?: 'primary' | 'secondary' | 'ghost'
  size?: 'sm' | 'md' | 'lg'
  disabled?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  variant: 'primary',
  size: 'md',
  type: 'submit',
})

const attrs = useAttrs()
const forwardedAttrs = computed(() => {
  const { class: _class, ...rest } = attrs

  return rest
})

const classes = computed(() => [
  'inline-flex items-center justify-center rounded-full font-bold transition duration-200 focus:outline-none focus:ring-4 disabled:cursor-not-allowed disabled:opacity-60',
  {
    'bg-primary px-5 py-3 text-slate-950 shadow-lg shadow-primary/25 hover:bg-primary-100 focus:ring-primary/25': props.variant === 'primary',
    'bg-secondary px-5 py-3 text-slate-950 shadow-lg shadow-secondary/25 hover:bg-secondary/90 focus:ring-secondary/30': props.variant === 'secondary',
    'border border-white/15 bg-white/[0.06] px-5 py-3 text-ink hover:border-primary/50 hover:bg-primary/10 hover:text-primary focus:ring-primary/15': props.variant === 'ghost',
    'text-sm': props.size === 'sm',
    'text-base': props.size === 'md',
    'px-7 py-4 text-lg': props.size === 'lg',
  },
])
</script>

<template>
  <NuxtLink
    v-if="to"
    v-bind="forwardedAttrs"
    :to="to"
    :class="[classes, attrs.class]"
  >
    <slot />
  </NuxtLink>

  <a
    v-else-if="href"
    v-bind="forwardedAttrs"
    :href="href"
    :class="[classes, attrs.class]"
  >
    <slot />
  </a>

  <button
    :disabled="disabled"
    v-else
    v-bind="forwardedAttrs"
    :type="type"
    :class="[classes, attrs.class]"
  >
    <slot />
  </button>
</template>
