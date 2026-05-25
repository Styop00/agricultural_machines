<template>
  <div>
    <ContentPageHero
      eyebrow="Warranty"
      title="Warranty options for added peace of mind."
      description="Explain available coverage, inspected components, exclusions, and support options for vehicle buyers."
    />
    <section class="mx-auto grid max-w-7xl gap-8 px-4 pb-16 sm:px-6 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
      <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-1">
        <BaseCard>
          <h2 class="text-2xl font-black">
            Coverage Options
          </h2>
          <p class="mt-3 text-ink/60">
            Add details for eligible vehicles, coverage length, components, and claim steps.
          </p>
        </BaseCard>
        <BaseCard>
          <h2 class="text-2xl font-black">
            Service Support
          </h2>
          <p class="mt-3 text-ink/60">
            Use this section to connect warranty coverage with your maintenance workflow.
          </p>
        </BaseCard>
      </div>

      <PageRequestForm
        title="Want to learn more about our warranty coverage?"
        description="Speak with our team to learn more about what is covered, who is eligible, and how warranty support works."
        request-type="warranty coverage"
        source-page="Warranty"
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