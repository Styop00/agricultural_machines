<script setup lang="ts">
import ContentPageHero from "~/components/sections/ContentPageHero.vue";
import ContactPanel from "~/components/sections/ContactPanel.vue";
import WorkingTimes from "~/components/sections/WorkingTimes.vue";

const { loadCompany } = useStorefrontData()
const { data: company } = await loadCompany()

useSeoMeta({
  title: 'Contact | FieldPro Motor Gallery',
  description: 'Contact FieldPro Motor Gallery about vehicles, delivery, and service.',
})
</script>

<template>
  <div>
    <ContentPageHero
      eyebrow="Contact"
      title="Have questions? We are here to help."
      description="Reach out about inventory, delivery, maintenance, warranty, or a specific vehicle request."
    />
    <ContactPanel :company="company" />
    <WorkingTimes :company="company" />
  </div>
</template>
