<script setup lang="ts">
import type { Company } from '~/types/api'
import PageRequestForm from "~/components/sections/PageRequestForm.vue";
import BaseCard from "~/components/ui/BaseCard.vue";
import BaseBadge from "~/components/ui/BaseBadge.vue";
import BrandIcon from "~/components/ui/BrandIcon.vue";

interface Props {
  company?: Company | null
}

const props = defineProps<Props>()
const appConfig = useAppConfig()

const contact = computed(() => props.company ?? appConfig.shop)
</script>

<template>
  <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid gap-8 lg:grid-cols-[0.85fr_1.15fr]">
      <BaseCard class="relative overflow-hidden !bg-primary-900 text-white">
        <div class="absolute -right-12 top-8 size-32 text-primary/20">
          <BrandIcon name="pin" />
        </div>
        <BaseBadge tone="secondary">
          Contact Us
        </BaseBadge>
        <h2 class="mt-5 text-4xl font-black">
          Found a machine? Let us help you move fast.
        </h2>
        <p class="mt-4 text-white/70">
          Ask about availability, request delivery details, or schedule a yard visit.
        </p>
        <div class="mt-8 space-y-4 text-white/80">
          <p>{{ contact.address }}</p>
          <p>{{ contact.phone }}</p>
          <p>{{ contact.email }}</p>
        </div>
      </BaseCard>

      <PageRequestForm
        title="Send us a message"
        description="Ask about availability, delivery, warranty, service, or a specific machine."
        request-type="contact"
        source-page="Contact"
        submit-label="Send Message"
      />
    </div>
  </section>
</template>
