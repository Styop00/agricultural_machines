<script setup lang="ts">
import { fallbackWorkingTimes } from '~/utils/fallback-data'
import type { Company, WorkingTime } from '~/types/api'
import BrandIcon from "~/components/ui/BrandIcon.vue";

interface Props {
  company?: Company | null
}

const props = defineProps<Props>()
const appConfig = useAppConfig()

const selectedDepartment = ref<'company' | 'services'>('company')
const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']

const company = computed(() => props.company ?? {
  id: 0,
  name: appConfig.shop.name,
  address: appConfig.shop.address,
  phone: appConfig.shop.phone,
  email: appConfig.shop.email,
  working_times: fallbackWorkingTimes,
})

const departmentTabs = [
  { label: 'Company', value: 'company' },
  { label: 'Service', value: 'services' },
] as const

const sortDay = (time: WorkingTime) => time.day_of_week === 0 ? 7 : time.day_of_week

const formatTime = (time: string | null) => {
  if (!time) {
    return ''
  }

  const [hour, minute] = time.split(':')
  const date = new Date()
  date.setHours(Number(hour), Number(minute), 0, 0)

  return new Intl.DateTimeFormat('en-US', {
    hour: 'numeric',
    minute: '2-digit',
  }).format(date)
}

const activeWorkingTimes = computed(() => {
  const times = company.value.working_times?.length ? company.value.working_times : fallbackWorkingTimes

  return times
    .filter((time) => time.department === selectedDepartment.value)
    .sort((a, b) => sortDay(a) - sortDay(b))
})
</script>

<template>
  <footer class="border-t border-white/10 bg-slate-950 text-white">
    <div class="relative overflow-hidden">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_20%,rgba(255,255,255,0.12),transparent_24rem)] opacity-70" />
      <div class="relative mx-auto grid max-w-7xl gap-12 px-4 py-14 sm:px-6 lg:grid-cols-[1.1fr_1fr] lg:px-8">
        <div>
          <div class="mb-5 flex items-center gap-3">
            <span class="flex size-12 items-center justify-center rounded-2xl border border-secondary/25 bg-secondary/15 p-2.5 text-secondary">
              <BrandIcon name="roadster" />
            </span>
            <span>
              <span class="block text-xl font-black">{{ company.name }}</span>
              <span class="text-xs font-semibold uppercase tracking-[0.22em] text-white/50">Green Bay, WI</span>
            </span>
          </div>

          <address class="not-italic text-sm font-semibold leading-6 text-white/75">
            {{ company.address }}
          </address>

          <div class="mt-7 max-w-md">
            <div class="mb-3 flex border-b border-white/15 text-sm font-black uppercase tracking-wide">
              <button
                v-for="tab in departmentTabs"
                :key="tab.value"
                type="button"
                class="border-b-2 px-0 py-2 pr-7 transition"
                :class="selectedDepartment === tab.value ? 'border-secondary text-secondary' : 'border-transparent text-white/75 hover:text-white'"
                @click="selectedDepartment = tab.value"
              >
                {{ tab.label }}
              </button>
            </div>

            <div class="space-y-2 text-sm">
              <div
                v-for="time in activeWorkingTimes"
                :key="time.id"
                class="grid grid-cols-[6.5rem_1fr] gap-4 text-white/70"
              >
                <span>{{ dayNames[time.day_of_week] }}:</span>
                <span class="text-secondary/90">
                  {{ time.is_closed ? 'Closed' : `${formatTime(time.opens_at)} to ${formatTime(time.closes_at)}` }}
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="lg:pl-10">
          <NuxtLink
            to="/contact"
            class="inline-flex w-full items-center justify-center border border-white/20 bg-transparent py-4 font-black uppercase tracking-wide text-white transition hover:bg-white/10"
          >
            Contact Us
          </NuxtLink>

          <div class="mt-7">
            <h2 class="max-w-xl text-2xl font-black leading-tight text-secondary sm:text-3xl">
              Have questions? Get in touch with us - we are here to help.
            </h2>
            <p class="mt-4 max-w-xl text-sm leading-6 text-white/70">
              If you have any questions or concerns, please do not hesitate to reach out. We would be happy to assist you and provide any information you may need.
            </p>
          </div>

          <div class="mt-8 grid gap-2 text-sm font-semibold text-white/70">
            <a :href="`tel:${company.phone}`">{{ company.phone }}</a>
            <a :href="`mailto:${company.email}`">{{ company.email }}</a>
          </div>
        </div>
      </div>
    </div>
    <div class="border-t border-white/10 px-4 py-5 text-center text-sm text-white/55">
      © {{ new Date().getFullYear() }} {{ appConfig.shop.name }}. All rights reserved.
    </div>
  </footer>
</template>
