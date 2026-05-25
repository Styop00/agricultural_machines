<script setup lang="ts">
import BaseBadge from "~/components/ui/BaseBadge.vue";
import BaseButton from "~/components/ui/BaseButton.vue";
import BrandIcon from "~/components/ui/BrandIcon.vue";

const appConfig = useAppConfig()

const stats = [
  { value: '120+', label: 'Inspection Points' },
  { value: '48h', label: 'Fast Quote Window' },
  { value: 'Nationwide', label: 'Delivery Ready' },
] as const

const sellingPoints = [
  { icon: 'shield', label: 'Verified condition reports' },
  { icon: 'carrier', label: 'Transport coordination' },
  { icon: 'tools', label: 'Service-backed handoff' },
] as const
</script>

<template>
  <section class="relative isolate overflow-hidden">
    <div class="absolute inset-0 -z-20">
      <img
        src="/home-hero-tractor.png"
        alt=""
        class="size-full object-cover opacity-45 blur-[2px] scale-105"
      >
      <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/82 to-slate-950/40" />
      <div class="absolute inset-0 bg-gradient-to-t from-[#03070a] via-transparent to-[#03070a]/70" />
    </div>
    <div class="absolute left-1/2 top-16 -z-10 size-[28rem] -translate-x-1/2 rounded-full bg-primary/20 blur-[140px]" />
    <div class="absolute bottom-6 right-0 -z-10 size-96 rounded-full bg-secondary/15 blur-[130px]" />

    <div class="mx-auto grid min-h-[calc(100vh-5rem)] max-w-7xl items-center gap-12 px-4 py-16 sm:px-6 lg:grid-cols-[1.04fr_0.96fr] lg:px-8 lg:py-24">
      <div class="max-w-4xl">
        <BaseBadge tone="secondary">
          {{ appConfig.shop.hero.eyebrow }}
        </BaseBadge>

        <h1 class="mt-6 text-balance text-4xl font-black leading-[0.98] tracking-[-0.055em] text-white sm:text-6xl lg:text-8xl">
          {{ appConfig.shop.hero.title }}
        </h1>

        <p class="mt-6 max-w-2xl text-base leading-8 text-white/72 sm:text-xl sm:leading-9">
          {{ appConfig.shop.hero.description }}
        </p>

        <div class="mt-9 flex flex-col gap-3 sm:flex-row">
          <BaseButton
            to="/inventory"
            size="lg"
            class="w-full sm:w-auto"
          >
            Browse Inventory
          </BaseButton>
          <BaseButton
            to="/contact"
            variant="ghost"
            size="lg"
            class="w-full sm:w-auto"
          >
            Request Expert Help
          </BaseButton>
        </div>

        <div class="mt-10 grid max-w-2xl gap-3 sm:grid-cols-3">
          <div
            v-for="stat in stats"
            :key="stat.label"
            class="rounded-3xl border border-white/10 bg-white/[0.07] p-4 shadow-xl shadow-black/20 backdrop-blur"
          >
            <p class="text-2xl font-black text-primary">
              {{ stat.value }}
            </p>
            <p class="mt-1 text-xs font-bold uppercase tracking-[0.18em] text-white/55">
              {{ stat.label }}
            </p>
          </div>
        </div>
      </div>

      <div class="relative hidden lg:block">
        <div class="absolute -inset-6 rounded-[2.5rem] bg-primary/20 blur-3xl" />
        <div class="relative overflow-hidden rounded-[2rem] border border-white/15 bg-white/[0.07] p-5 shadow-2xl shadow-black/40 backdrop-blur-xl">
          <div class="relative overflow-hidden rounded-[1.5rem]">
            <img
              src="/home-hero-tractor.png"
              alt="Agricultural machine working in a field"
              class="aspect-[4/5] w-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/10 to-transparent" />
            <div class="absolute left-5 top-5 rounded-full border border-white/15 bg-black/35 px-4 py-2 text-xs font-black uppercase tracking-[0.2em] text-secondary backdrop-blur">
              Field ready
            </div>
          </div>

          <div class="absolute bottom-8 left-8 right-8">
            <div class="rounded-3xl border border-white/15 bg-slate-950/78 p-5 shadow-2xl shadow-black/40 backdrop-blur-xl">
              <p class="text-xs font-black uppercase tracking-[0.22em] text-primary">
                Inspected inventory
              </p>
              <h2 class="mt-3 text-3xl font-black leading-tight text-white">
                Heavy-duty machines with clear details before you call.
              </h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mx-auto grid max-w-7xl gap-3 px-4 pb-12 sm:px-6 md:grid-cols-3 lg:px-8">
      <div
        v-for="point in sellingPoints"
        :key="point.label"
        class="flex items-center gap-3 rounded-3xl border border-white/10 bg-white/[0.05] p-4 text-sm font-black uppercase tracking-[0.14em] text-white/70 backdrop-blur"
      >
        <span class="flex size-11 shrink-0 items-center justify-center rounded-2xl border border-primary/25 bg-primary/10 p-2.5 text-primary">
          <BrandIcon :name="point.icon" />
        </span>
        {{ point.label }}
      </div>
    </div>
  </section>
</template>
