<script setup lang="ts">
interface Props {
  name: 'roadster' | 'key' | 'carrier' | 'shield' | 'gauge' | 'engine' | 'pin' | 'tools'
}

defineProps<Props>()
</script>

<template>
  <svg
    viewBox="0 0 64 64"
    fill="none"
    aria-hidden="true"
    class="size-full"
  >
    <g
      stroke="currentColor"
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="3.4"
    >
      <template v-if="name === 'roadster'">
        <path d="M9 36h7l6-11h19l7 11h7" />
        <path d="M18 36h28c4 0 8 4 8 8v4H10v-4c0-4 4-8 8-8Z" />
        <path d="M23 36l5-6h10l6 6" />
        <path d="M19 48a6 6 0 1 0 12 0" />
        <path d="M35 48a6 6 0 1 0 12 0" />
      </template>

      <template v-else-if="name === 'key'">
        <circle cx="22" cy="28" r="9" />
        <path d="M30 34l21 21" />
        <path d="M42 46l5-5" />
        <path d="M48 52l5-5" />
        <path d="M19 28h6" />
      </template>

      <template v-else-if="name === 'carrier'">
        <path d="M8 39h35l8-9h5v18H8V39Z" />
        <path d="M14 31h23l6 8" />
        <path d="M20 48a5 5 0 1 0 10 0" />
        <path d="M42 48a5 5 0 1 0 10 0" />
        <path d="M18 25h17" />
      </template>

      <template v-else-if="name === 'shield'">
        <path d="M32 7l21 8v15c0 13-8 22-21 27-13-5-21-14-21-27V15l21-8Z" />
        <path d="M22 32l7 7 15-16" />
      </template>

      <template v-else-if="name === 'gauge'">
        <path d="M14 45a22 22 0 1 1 36 0" />
        <path d="M32 43l11-18" />
        <path d="M21 39h-5" />
        <path d="M48 39h-5" />
        <path d="M32 21v-5" />
      </template>

      <template v-else-if="name === 'engine'">
        <path d="M18 25h29l7 8v14H16V33l2-8Z" />
        <path d="M25 25v-7h15v7" />
        <path d="M10 37h6" />
        <path d="M54 39h5" />
        <path d="M24 36h9" />
        <path d="M24 44h18" />
      </template>

      <template v-else-if="name === 'pin'">
        <path d="M32 57s18-17 18-32a18 18 0 0 0-36 0c0 15 18 32 18 32Z" />
        <path d="M26 27h12" />
        <path d="M25 34h14" />
        <path d="M29 20h6" />
      </template>

      <template v-else>
        <path d="M21 10l10 10-8 8-10-10" />
        <path d="M29 28l25 25" />
        <path d="M47 12l5 5-13 13-5-5 13-13Z" />
        <path d="M13 52l15-15" />
      </template>
    </g>
  </svg>
</template>
