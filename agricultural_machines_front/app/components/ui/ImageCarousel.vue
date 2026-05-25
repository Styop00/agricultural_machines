<script setup lang="ts">
import type { CarImage } from "~/types/api";
import BrandIcon from "~/components/ui/BrandIcon.vue";

interface Props {
  images?: CarImage[]
  alt: string
  showThumbnails?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  images: () => [],
  showThumbnails: false,
})

const activeIndex = ref(0)

const usableImages = computed(() => props.images.filter((image) => image.url))
const hasImages = computed(() => usableImages.value.length > 0)
const hasMultipleImages = computed(() => usableImages.value.length > 1)
const activeImage = computed(() => usableImages.value[activeIndex.value])

watch(usableImages, () => {
  activeIndex.value = 0
})

const goToImage = (index: number) => {
  activeIndex.value = index
}

const showPrevious = () => {
  activeIndex.value = activeIndex.value === 0
    ? usableImages.value.length - 1
    : activeIndex.value - 1
}

const showNext = () => {
  activeIndex.value = activeIndex.value === usableImages.value.length - 1
    ? 0
    : activeIndex.value + 1
}
</script>

<template>
  <div class="space-y-3">
    <div class="group/carousel relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-slate-950 via-primary-900 to-slate-900 text-primary">
      <img
        v-if="hasImages"
        :src="activeImage?.url || ''"
        :alt="activeImage?.alt_text || alt"
        class="size-full object-cover transition duration-500 group-hover/carousel:scale-105"
      >
      <div
        v-if="hasImages"
        class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/10 to-transparent"
      />
      <div
        v-else
        class="flex size-full items-center justify-center p-10 text-center text-primary"
      >
        <BrandIcon name="roadster" />
      </div>

      <template v-if="hasMultipleImages">
        <button
          type="button"
          aria-label="Show previous image"
          class="absolute left-3 top-1/2 flex size-10 -translate-y-1/2 items-center justify-center rounded-full border border-white/15 bg-slate-950/70 text-white shadow-xl backdrop-blur transition hover:border-primary/50 hover:text-primary"
          @click.stop="showPrevious"
        >
          ‹
        </button>
        <button
          type="button"
          aria-label="Show next image"
          class="absolute right-3 top-1/2 flex size-10 -translate-y-1/2 items-center justify-center rounded-full border border-white/15 bg-slate-950/70 text-white shadow-xl backdrop-blur transition hover:border-primary/50 hover:text-primary"
          @click.stop="showNext"
        >
          ›
        </button>

        <div class="absolute bottom-4 left-1/2 flex -translate-x-1/2 gap-2">
          <button
            v-for="(_, index) in usableImages"
            :key="index"
            type="button"
            :aria-label="`Show image ${index + 1}`"
            class="h-1.5 rounded-full transition"
            :class="activeIndex === index ? 'w-7 bg-primary' : 'w-2 bg-white/45 hover:bg-white/80'"
            @click.stop="goToImage(index)"
          />
        </div>
      </template>
    </div>

    <div
      v-if="showThumbnails && hasMultipleImages"
      class="grid grid-cols-4 gap-3 sm:grid-cols-5"
    >
      <button
        v-for="(image, index) in usableImages"
        :key="image.id"
        type="button"
        class="aspect-[4/3] overflow-hidden rounded-2xl border transition"
        :class="activeIndex === index ? 'border-primary ring-2 ring-primary/25' : 'border-white/10 opacity-70 hover:border-primary/50 hover:opacity-100'"
        @click="goToImage(index)"
      >
        <img
          :src="image.url || ''"
          :alt="image.alt_text || `${alt} thumbnail ${index + 1}`"
          class="size-full object-cover"
        >
      </button>
    </div>
  </div>
</template>
