<template>
  <div>
    <ContentPageHero
      eyebrow="Nationwide Delivery"
      title="Secure vehicle delivery from our showroom to your driveway."
      description="Coordinate dependable transport for premium vehicles across long distances with clear communication."
    />
    <section class="mx-auto grid max-w-7xl gap-8 px-4 pb-16 sm:px-6 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
      <BaseCard>
        <div class="grid gap-8 md:grid-cols-3">
          <div>
            <BaseBadge>1</BaseBadge>
            <h2 class="mt-4 text-2xl font-black">
              Confirm Vehicle
            </h2>
            <p class="mt-3 text-ink/60">
              Select inventory and review condition, location, and delivery requirements.
            </p>
          </div>
          <div>
            <BaseBadge>2</BaseBadge>
            <h2 class="mt-4 text-2xl font-black">
              Plan Transport
            </h2>
            <p class="mt-3 text-ink/60">
              Match the vehicle to the right transport setup and delivery timing.
            </p>
          </div>
          <div>
            <BaseBadge>3</BaseBadge>
            <h2 class="mt-4 text-2xl font-black">
              Deliver Carefully
            </h2>
            <p class="mt-3 text-ink/60">
              Receive your vehicle securely with clear communication along the way.
            </p>
          </div>
        </div>
      </BaseCard>
      <PageRequestForm
        title="Need your vehicle delivered?"
        description="Contact us today and we will coordinate fast, secure nationwide delivery straight to your door."
        request-type="nationwide delivery"
        source-page="Nationwide Delivery"
        submit-label="Submit Request"
      />
    </section>
  </div>
</template>
<script setup lang="ts">
import ContentPageHero from "~/components/sections/ContentPageHero.vue";
import PageRequestForm from "~/components/sections/PageRequestForm.vue";
import BaseCard from "~/components/ui/BaseCard.vue";
import BaseBadge from "~/components/ui/BaseBadge.vue";
</script>