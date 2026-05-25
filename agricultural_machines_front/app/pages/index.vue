<script setup lang="ts">
import HeroSection from "~/components/sections/HeroSection.vue";
import FeatureGrid from "~/components/sections/FeatureGrid.vue";
import FeaturedInventory from "~/components/sections/FeaturedInventory.vue";
import IntroContent from "~/components/sections/IntroContent.vue";
import WorkingTimes from "~/components/sections/WorkingTimes.vue";
import ContactPanel from "~/components/sections/ContactPanel.vue";

const { loadCars, loadCompany } = useStorefrontData()
const { data: cars } = await loadCars('featured-cars', { per_page: 6 })
const { data: company } = await loadCompany()

useSeoMeta({
  title: 'FieldPro Machinery | Premium Agricultural Equipment',
  description: 'Browse inspected agricultural machinery, delivery options, warranty support, and a premium dark showroom experience.',
})
</script>

<template>
  <div>
    <HeroSection />
    <FeatureGrid />
    <FeaturedInventory :cars="cars || []" />
    <IntroContent />
    <ContactPanel :company="company" />
  </div>
</template>
