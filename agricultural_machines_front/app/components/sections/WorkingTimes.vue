<script setup lang="ts">
import type { Company, WorkingTime } from '~/types/api'
import SectionHeader from "~/components/ui/SectionHeader.vue";
import BaseCard from "~/components/ui/BaseCard.vue";

interface Props {
  company?: Company | null
}

const props = defineProps<Props>()

const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']

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

const groupedTimes = computed(() => {
  const times = props.company?.working_times ?? []

  return ['company', 'services'].map((department) => ({
    department,
    label: department === 'company' ? 'Company' : 'Services',
    times: times
      .filter((time) => time.department === department)
      .sort((a, b) => sortDay(a) - sortDay(b)),
  }))
})

const sortDay = (time: WorkingTime) => time.day_of_week === 0 ? 7 : time.day_of_week
</script>

<template>
  <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr]">
      <SectionHeader
        eyebrow="Business Hours"
        title="Sales and service schedules."
        description="Plan a showroom visit, ask about a listing, or schedule support with working times coming from the backend."
      />

      <div class="grid gap-5 md:grid-cols-2">
        <BaseCard
          v-for="group in groupedTimes"
          :key="group.department"
        >
          <h3 class="text-2xl font-black text-ink">
            {{ group.label }}
          </h3>
          <div class="mt-5 divide-y divide-white/10">
            <div
              v-for="time in group.times"
              :key="time.id"
              class="flex items-center justify-between gap-4 py-3 text-sm"
            >
              <span class="font-semibold text-ink">{{ dayNames[time.day_of_week] }}</span>
              <span class="text-ink/60">
                {{ time.is_closed ? 'Closed' : `${formatTime(time.opens_at)} to ${formatTime(time.closes_at)}` }}
              </span>
            </div>
          </div>
        </BaseCard>
      </div>
    </div>
  </section>
</template>
