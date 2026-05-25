<script setup lang="ts">
import BaseButton from "~/components/ui/BaseButton.vue";
import BaseFileInput from "~/components/ui/BaseFileInput.vue";
import BaseInput from "~/components/ui/BaseInput.vue";
import BaseSelect from "~/components/ui/BaseSelect.vue";
import BaseTextarea from "~/components/ui/BaseTextarea.vue";

const config = useRuntimeConfig()
const appConfig = useAppConfig()

const positions = [
  {
    title: 'Sales Consultant - Green Bay, WI',
    description:
      'Help customers compare inspected vehicles, answer buying questions, and guide them through a clear, professional purchase process.',
  },
  {
    title: 'Vehicle Detailer & Lot Coordinator - Green Bay, WI',
    description:
      'Keep vehicles clean, organized, and ready for photos, showroom visits, and delivery while supporting inventory presentation across the lot.',
  },
  {
    title: 'Service Technician - Green Bay, WI',
    description:
      'Inspect, diagnose, and maintain vehicles so every listing is prepared for dependable ownership.',
  },
]

const positionOptions = computed(() => positions.map((position) => ({
  label: position.title,
  value: position.title,
})))

const form = reactive({
  fullName: '',
  phone: '',
  email: '',
  position: '',
  message: '',
  cv: null as File | null,
})

const isSubmitting = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

const handleFileChange = (event: Event) => {
  const input = event.target as HTMLInputElement
  form.cv = input.files?.[0] ?? null
}

const resetForm = () => {
  form.fullName = ''
  form.phone = ''
  form.email = ''
  form.position = ''
  form.message = ''
  form.cv = null
}

const submitApplication = async () => {
  isSubmitting.value = true
  successMessage.value = ''
  errorMessage.value = ''

  const payload = new FormData()
  payload.append('full_name', form.fullName)
  payload.append('phone', form.phone)
  payload.append('email', form.email)
  payload.append('position', form.position)
  payload.append('message', form.message)

  if (form.cv) {
    payload.append('cv', form.cv)
  }

  try {
    const response = await $fetch<{ message: string }>('career-applications', {
      baseURL: config.public.apiBase,
      method: 'POST',
      body: payload,
    })

    successMessage.value = response.message
    resetForm()
  } catch (submitError) {
    const error = submitError as { data?: { message?: string } }
    errorMessage.value = error.data?.message ?? 'We could not send your application. Please try again.'
  } finally {
    isSubmitting.value = false
  }
}

useSeoMeta({
  title: `Careers | ${appConfig.shop.name}`,
  description: `Apply for open roles at ${appConfig.shop.name}.`,
})
</script>

<template>
  <section class="relative overflow-hidden bg-primary-900 text-white">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_15%_10%,rgba(255,255,255,0.16),transparent_26rem),linear-gradient(135deg,rgba(0,0,0,0.25),rgba(0,0,0,0.75))]" />
    <div class="relative mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:px-6 lg:grid-cols-[1fr_0.95fr] lg:px-8">
      <div>
        <p class="text-xs font-black uppercase tracking-[0.24em] text-white">
          {{ appConfig.shop.name }}
        </p>
        <h1 class="mt-3 text-5xl font-black uppercase tracking-tight text-secondary sm:text-6xl">
          Careers
        </h1>
        <p class="mt-8 max-w-2xl text-sm leading-7 text-white/75">
          If sharp vehicles and great customer experiences get your attention, a career at {{ appConfig.shop.name }} may be the right fit. We are looking for team members who are passionate about vehicles, customer service, and dependable work.
        </p>

        <a
          href="#career-application"
          class="mt-5 inline-flex text-sm font-black text-secondary underline underline-offset-4"
        >
          Apply Now
        </a>

        <div class="mt-10 grid gap-5 md:grid-cols-2">
          <article
            v-for="position in positions"
            :key="position.title"
            class="border border-white/25 bg-black/25 p-5 backdrop-blur"
          >
            <h2 class="text-lg font-black uppercase leading-6 text-white">
              {{ position.title }}
            </h2>
            <p class="mt-3 text-sm leading-6 text-white/70">
              {{ position.description }}
            </p>
          </article>
        </div>
      </div>

      <div
        id="career-application"
        class="bg-black/45 p-6 shadow-2xl shadow-black/30 backdrop-blur sm:p-8"
      >
        <h2 class="text-3xl font-black uppercase leading-tight">
          Apply to<br>
          <span class="text-secondary">{{ appConfig.shop.name }}</span>
        </h2>

        <form
          class="mt-8 grid gap-4"
          @submit.prevent="submitApplication"
        >
          <div class="grid gap-4 sm:grid-cols-2">
            <BaseInput
              id="career-full-name"
              v-model="form.fullName"
              label="Full Name: *"
              required
            />

            <BaseInput
              id="career-phone"
              v-model="form.phone"
              label="Phone: *"
              type="tel"
              required
            />
          </div>

          <div class="grid gap-4 sm:grid-cols-2">
            <BaseInput
              id="career-email"
              v-model="form.email"
              label="Email: *"
              type="email"
              required
            />

            <BaseSelect
              id="career-position"
              v-model="form.position"
              label="Position: *"
              placeholder="Select a position"
              :options="positionOptions"
              required
            />
          </div>

          <BaseTextarea
            id="career-message"
            v-model="form.message"
            label="Message"
          />

          <BaseFileInput
            id="career-cv"
            label="C.V."
            accept=".pdf,.doc,.docx,.txt"
            @change="handleFileChange"
          />

          <BaseButton
            type="submit"
            :disabled="isSubmitting"
          >
            {{ isSubmitting ? 'Submitting...' : 'Submit' }}
          </BaseButton>

          <p
            v-if="successMessage"
            class="rounded-2xl border border-primary/25 bg-primary/10 px-4 py-3 text-sm font-semibold text-primary"
          >
            {{ successMessage }}
          </p>
          <p
            v-if="errorMessage"
            class="rounded-2xl border border-red-400/25 bg-red-500/10 px-4 py-3 text-sm font-semibold text-red-200"
          >
            {{ errorMessage }}
          </p>
        </form>
      </div>
    </div>
  </section>
</template>