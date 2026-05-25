<script setup lang="ts">
import BaseButton from "~/components/ui/BaseButton.vue";
import BrandIcon from "~/components/ui/BrandIcon.vue";

const appConfig = useAppConfig()

const links = [
  { label: 'Inventory', to: '/inventory' },
  { label: 'Maintenance', to: '/maintenance' },
  { label: 'Nationwide Delivery', to: '/nationwide-delivery' },
  { label: 'Money Back Guarantee', to: '/money-back-guarantee' },
  { label: 'Warranty', to: '/warranty' },
]

const aboutLinks = [
  { label: 'FAQ', to: '/faq' },
  { label: 'Careers', to: '/careers' },
  { label: 'Our Team', to: '/our-team' },
  { label: 'Contact Us', to: '/contact' },
  { label: 'Customer Testimonials', to: '/customer-testimonials' },
]

const route = useRoute()
const isMenuOpen = ref(false)
const mobileLinks = [...links, ...aboutLinks]

watch(
  () => route.fullPath,
  () => {
    isMenuOpen.value = false
  },
)
</script>

<template>
  <header class="sticky top-0 z-40 border-b border-white/10 bg-slate-950/78 backdrop-blur-2xl">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-5 px-4 py-4 sm:px-6 lg:px-8">
      <NuxtLink
        to="/"
        class="flex items-center gap-3"
      >
        <span class="flex size-12 items-center justify-center rounded-2xl border border-primary/25 bg-primary/10 p-2.5 text-primary shadow-lg shadow-primary/20">
          <BrandIcon name="roadster" />
        </span>
      </NuxtLink>

      <nav class="hidden items-center gap-5 xl:gap-6 lg:flex">
        <NuxtLink
          v-for="link in links"
          :key="link.to"
          :to="link.to"
          class="text-sm font-bold text-ink/65 transition hover:text-primary"
          active-class="text-primary"
        >
          {{ link.label }}
        </NuxtLink>

        <div class="group relative">
          <NuxtLink
            to="/contact"
            class="inline-flex items-center gap-2 text-sm font-bold text-ink/65 transition hover:text-primary"
            active-class="text-primary"
          >
            About
            <span class="text-primary transition group-hover:translate-y-0.5">⌄</span>
          </NuxtLink>

          <div class="invisible absolute right-0 top-full w-64 translate-y-3 border border-white/15 bg-primary-900 py-2 opacity-0 shadow-2xl shadow-primary-900/20 transition duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100">
            <NuxtLink
              v-for="link in aboutLinks"
              :key="link.to"
              :to="link.to"
              class="flex items-center justify-between border-b border-white/10 px-5 py-3 text-sm font-black uppercase tracking-wide text-white transition last:border-b-0 hover:bg-white/10 hover:text-secondary"
              active-class="text-secondary"
            >
              {{ link.label }}
              <span class="text-secondary">›</span>
            </NuxtLink>
          </div>
        </div>
      </nav>

      <div class="flex items-center gap-3">
        <a
          :href="`tel:${appConfig.shop.phone}`"
          class="hidden text-sm font-black text-primary xl:block"
        >
          {{ appConfig.shop.phone }}
        </a>
        <BaseButton
          to="/contact"
          size="sm"
          class="hidden sm:inline-flex"
        >
          Get Quote
        </BaseButton>
        <button
          type="button"
          class="inline-flex size-11 items-center justify-center rounded-2xl border border-white/15 bg-white/[0.06] text-ink transition hover:border-primary/50 hover:text-primary lg:hidden"
          :aria-expanded="isMenuOpen"
          aria-controls="mobile-navigation"
          aria-label="Toggle navigation menu"
          @click="isMenuOpen = !isMenuOpen"
        >
          <span class="relative h-4 w-5">
            <span
              class="absolute left-0 top-0 h-0.5 w-full rounded-full bg-current transition"
              :class="isMenuOpen ? 'translate-y-[7px] rotate-45' : ''"
            />
            <span
              class="absolute left-0 top-[7px] h-0.5 w-full rounded-full bg-current transition"
              :class="isMenuOpen ? 'opacity-0' : ''"
            />
            <span
              class="absolute bottom-0 left-0 h-0.5 w-full rounded-full bg-current transition"
              :class="isMenuOpen ? '-translate-y-[7px] -rotate-45' : ''"
            />
          </span>
        </button>
      </div>
    </div>

    <Transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="-translate-y-2 opacity-0"
      enter-to-class="translate-y-0 opacity-100"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="translate-y-0 opacity-100"
      leave-to-class="-translate-y-2 opacity-0"
    >
      <div
        v-if="isMenuOpen"
        id="mobile-navigation"
        class="border-t border-white/10 bg-slate-950/95 px-4 pb-5 pt-3 shadow-2xl shadow-black/40 backdrop-blur-2xl lg:hidden"
      >
        <nav class="mx-auto grid max-w-7xl gap-2">
          <NuxtLink
            v-for="link in mobileLinks"
            :key="link.to"
            :to="link.to"
            class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/[0.04] px-4 py-3 text-sm font-black uppercase tracking-[0.12em] text-ink/75 transition hover:border-primary/35 hover:bg-primary/10 hover:text-primary"
            active-class="border-primary/40 text-primary"
          >
            {{ link.label }}
            <span class="text-secondary">›</span>
          </NuxtLink>
        </nav>

        <div class="mx-auto mt-4 grid max-w-7xl gap-3 sm:grid-cols-2">
          <BaseButton
            to="/contact"
            class="w-full"
          >
            Get Quote
          </BaseButton>
          <BaseButton
            :href="`tel:${appConfig.shop.phone}`"
            variant="ghost"
            class="w-full"
          >
            Call Now
          </BaseButton>
        </div>
      </div>
    </Transition>
  </header>
</template>
