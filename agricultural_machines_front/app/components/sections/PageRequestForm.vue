<script setup lang="ts">
import BaseButton from "~/components/ui/BaseButton.vue";
import BaseCard from "~/components/ui/BaseCard.vue";
import BaseInput from "~/components/ui/BaseInput.vue";
import BaseSelect from "~/components/ui/BaseSelect.vue";
import BaseTextarea from "~/components/ui/BaseTextarea.vue";

interface Props {
  title: string
  description: string
  requestType: string
  sourcePage: string
  submitLabel?: string
  includeAppointment?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  submitLabel: 'Submit Request',
  includeAppointment: false,
})

const config = useRuntimeConfig()

const contactTimeOptions = [
  { label: 'Morning', value: 'Morning' },
  { label: 'Afternoon', value: 'Afternoon' },
  { label: 'Evening', value: 'Evening' },
]

const form = reactive({
  fullName: '',
  phone: '',
  email: '',
  preferredContactTime: '',
  firstChoiceDate: '',
  firstChoiceTime: '',
  secondChoiceDate: '',
  secondChoiceTime: '',
  message: '',
})

const isSubmitting = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

const resetForm = () => {
  form.fullName = ''
  form.phone = ''
  form.email = ''
  form.preferredContactTime = ''
  form.firstChoiceDate = ''
  form.firstChoiceTime = ''
  form.secondChoiceDate = ''
  form.secondChoiceTime = ''
  form.message = ''
}

const buildMessage = () => [
  `Request type: ${props.requestType}`,
  `Source page: ${props.sourcePage}`,
  props.includeAppointment ? `First appointment choice: ${form.firstChoiceDate || 'Not specified'} ${form.firstChoiceTime || ''}`.trim() : '',
  props.includeAppointment ? `Second appointment choice: ${form.secondChoiceDate || 'Not specified'} ${form.secondChoiceTime || ''}`.trim() : '',
  '',
  'Message:',
  form.message,
].filter((line) => line !== '').join('\n')

const submitRequest = async () => {
  isSubmitting.value = true
  successMessage.value = ''
  errorMessage.value = ''

  try {
    const response = await $fetch<{ message: string }>('information-requests', {
      baseURL: config.public.apiBase,
      method: 'POST',
      body: {
        full_name: form.fullName,
        phone: form.phone,
        email: form.email,
        preferred_contact_time: form.preferredContactTime,
        request_type: props.requestType,
        source_page: props.sourcePage,
        message: buildMessage(),
      },
    })

    successMessage.value = response.message
    resetForm()
  } catch (submitError) {
    const error = submitError as { data?: { message?: string } }
    errorMessage.value = error.data?.message ?? 'We could not send your request. Please try again.'
  } finally {
    isSubmitting.value = false
  }
}
</script>

<template>
  <BaseCard class="relative overflow-visible !bg-black/45 text-white">
    <form
      class="grid gap-5"
      @submit.prevent="submitRequest"
    >
      <div>
        <p class="text-xs font-black uppercase tracking-[0.24em] text-primary">
          {{ requestType }}
        </p>
        <h2 class="mt-3 text-3xl font-black uppercase tracking-tight text-primary sm:text-4xl">
          {{ title }}
        </h2>
        <p class="mt-3 text-sm leading-6 text-white/65">
          {{ description }}
        </p>
      </div>

      <div class="grid gap-4 sm:grid-cols-2">
        <BaseInput
          id="request-full-name"
          v-model="form.fullName"
          label="Full Name: *"
          placeholder="Your full name"
        />
        <BaseInput
          id="request-phone"
          v-model="form.phone"
          label="Phone: *"
          type="tel"
          placeholder="Best phone number"
        />
        <BaseInput
          id="request-email"
          v-model="form.email"
          label="Email: *"
          type="email"
          placeholder="you@example.com"
        />
        <BaseSelect
          id="request-preferred-time"
          v-model="form.preferredContactTime"
          label="Preferred Time"
          placeholder="Preferred Time (optional)"
          :options="contactTimeOptions"
        />
      </div>

      <div
        v-if="includeAppointment"
        class="rounded-2xl border border-white/10 bg-white/[0.04] p-4"
      >
        <p class="mb-4 text-xs font-black uppercase tracking-[0.22em] text-white/70">
          Appointment
        </p>
        <div class="grid gap-4 sm:grid-cols-2">
          <BaseInput
            id="request-first-date"
            v-model="form.firstChoiceDate"
            label="1st Choice Date"
            type="date"
          />
          <BaseInput
            id="request-first-time"
            v-model="form.firstChoiceTime"
            label="1st Choice Time"
            type="time"
          />
          <BaseInput
            id="request-second-date"
            v-model="form.secondChoiceDate"
            label="2nd Choice Date"
            type="date"
          />
          <BaseInput
            id="request-second-time"
            v-model="form.secondChoiceTime"
            label="2nd Choice Time"
            type="time"
          />
        </div>
      </div>

      <BaseTextarea
        id="request-message"
        v-model="form.message"
        label="Message: *"
        placeholder="Tell us what you need..."
      />

      <BaseButton
        type="submit"
        class="w-full"
        :disabled="isSubmitting"
      >
        {{ isSubmitting ? 'Sending...' : submitLabel }}
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
  </BaseCard>
</template>
