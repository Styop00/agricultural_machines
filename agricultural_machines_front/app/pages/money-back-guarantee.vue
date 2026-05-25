<template>
  <div>
    <ContentPageHero
      eyebrow="Money-Back Guarantee"
      title="Shop confidently with clear expectations."
      description="Use this page to publish your guarantee terms, inspection promises, return window, and any conditions by vehicle category."
    />
    <section class="mx-auto grid max-w-7xl gap-8 px-4 pb-16 sm:px-6 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
      <BaseCard>
        <div class="prose prose-lg max-w-none text-ink/70">
          <p>
            We built this page to support a confidence-building purchase flow for premium pre-owned vehicle sales.
          </p>
          <p>
            Replace this content with your exact guarantee rules, inspection policy, eligible vehicles, transport exclusions, and refund process.
          </p>
        </div>
      </BaseCard>
      <PageRequestForm
        title="Need more information about our guarantee?"
        description="Reach out to our team and enjoy a confident shopping experience with the assurance that we stand behind every vehicle we offer."
        request-type="money-back guarantee"
        source-page="Money-Back Guarantee"
        submit-label="Submit Request"
      />
    </section>
  </div>
</template>
<script setup lang="ts">
import ContentPageHero from "~/components/sections/ContentPageHero.vue";
import PageRequestForm from "~/components/sections/PageRequestForm.vue";
import BaseCard from "~/components/ui/BaseCard.vue";
</script>