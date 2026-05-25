<template>
  <div>
    <ContentPageHero
      eyebrow="Maintenance"
      title="Service support for vehicles that need to stay ready."
      description="From inspection planning to repair coordination, our service content supports confident pre-owned vehicle buying."
    />
    <section class="mx-auto grid max-w-7xl gap-8 px-4 pb-16 sm:px-6 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
      <div class="grid gap-6 md:grid-cols-3 lg:grid-cols-1">
        <BaseCard>
          <h2 class="text-2xl font-black text-ink">
            Inspections
          </h2>
          <p class="mt-3 text-ink/60">
            Pre-sale vehicle checks, condition reports, and readiness reviews.
          </p>
        </BaseCard>
        <BaseCard>
          <h2 class="text-2xl font-black text-ink">
            Repairs
          </h2>
          <p class="mt-3 text-ink/60">
            Practical support for mechanical, electrical, drivetrain, and detail-related service needs.
          </p>
        </BaseCard>
        <BaseCard>
          <h2 class="text-2xl font-black text-ink">
            Preventive Care
          </h2>
          <p class="mt-3 text-ink/60">
            Maintenance planning that keeps vehicles sharp before delivery and dependable after purchase.
          </p>
        </BaseCard>
      </div>

      <PageRequestForm
        title="Schedule an Appointment"
        description="Contact us to book your next maintenance, inspection, or service appointment."
        request-type="maintenance appointment"
        source-page="Maintenance"
        submit-label="Submit"
        include-appointment
      />
    </section>
  </div>
</template>
<script setup lang="ts">
import ContentPageHero from "~/components/sections/ContentPageHero.vue";
import PageRequestForm from "~/components/sections/PageRequestForm.vue";
import BaseCard from "~/components/ui/BaseCard.vue";
</script>