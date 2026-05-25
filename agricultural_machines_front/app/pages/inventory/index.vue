<script setup lang="ts">
import ContentPageHero from "~/components/sections/ContentPageHero.vue";
import MachineCard from "~/components/inventory/MachineCard.vue";
import BaseBadge from "~/components/ui/BaseBadge.vue";
import BaseButton from "~/components/ui/BaseButton.vue";
import BaseCard from "~/components/ui/BaseCard.vue";
import BaseInput from "~/components/ui/BaseInput.vue";
import BaseSelect from "~/components/ui/BaseSelect.vue";
import EmptyState from "~/components/ui/EmptyState.vue";
import { fallbackCars } from "~/utils/fallback-data";
import type { ApiCollection, Car } from "~/types/api";

const api = useApi()
const { loadCategories, loadManufacturers } = useStorefrontData()
const { data: categories } = await loadCategories()
const { data: manufacturers } = await loadManufacturers()

const filters = reactive({
  manufacturerId: '',
  categoryId: '',
  stock: '',
  yearMin: '',
  yearMax: '',
  priceMin: '',
  priceMax: '',
})

const manufacturerOptions = computed(() => (manufacturers.value || []).map((manufacturer) => ({
  label: manufacturer.name,
  value: String(manufacturer.id),
})))

const categoryOptions = computed(() => (categories.value || []).map((category) => ({
  label: category.name,
  value: String(category.id),
})))

const inventoryParams = computed(() => {
  const params = {
    per_page: 6,
    manufacturer_id: filters.manufacturerId,
    category_id: filters.categoryId,
    stock: filters.stock,
    year_min: filters.yearMin,
    year_max: filters.yearMax,
    price_min: filters.priceMin,
    price_max: filters.priceMax,
  }

  return Object.fromEntries(
    Object.entries(params).filter(([, value]) => value !== ''),
  ) as Record<string, string | number>
})

const inventorySentinel = ref<HTMLElement | null>(null)
const cars = ref<Car[]>([])
const currentPage = ref(1)
const lastPage = ref(1)
const pending = ref(false)
let inventoryRequestId = 0

const buildPageParams = (page: number) => ({
  ...inventoryParams.value,
  page,
})

const fallbackCollection = (): ApiCollection<Car> => ({
  data: fallbackCars,
  meta: {
    current_page: 1,
    last_page: 1,
    per_page: fallbackCars.length,
    total: fallbackCars.length,
  },
})

const { data: initialInventory } = await useAsyncData('inventory-cars-filtered', async () => {
  try {
    return await api.getCollection<Car>('cars', buildPageParams(1))
  } catch {
    return fallbackCollection()
  }
})

const applyInventoryResponse = (response: ApiCollection<Car>, shouldReset = false) => {
  const nextCars = response.data

  if (shouldReset) {
    cars.value = nextCars
  } else {
    const existingIds = new Set(cars.value.map((car) => car.id))
    cars.value = [
      ...cars.value,
      ...nextCars.filter((car) => !existingIds.has(car.id)),
    ]
  }

  currentPage.value = response.meta?.current_page ?? currentPage.value
  lastPage.value = response.meta?.last_page ?? currentPage.value
}

applyInventoryResponse(initialInventory.value ?? fallbackCollection(), true)

const hasMoreCars = computed(() => currentPage.value < lastPage.value)

const loadInventoryPage = async (page: number, shouldReset = false) => {
  if (pending.value && !shouldReset) {
    return
  }

  if (shouldReset) {
    currentPage.value = 1
    lastPage.value = 1
  }

  const requestId = ++inventoryRequestId
  pending.value = true

  try {
    const response = await api.getCollection<Car>('cars', buildPageParams(page))

    if (requestId !== inventoryRequestId) {
      return
    }

    applyInventoryResponse(response, shouldReset)
  } catch {
    if (shouldReset && requestId === inventoryRequestId) {
      applyInventoryResponse(fallbackCollection(), true)
    }
  } finally {
    if (requestId === inventoryRequestId) {
      pending.value = false
    }
  }
}

watch(inventoryParams, () => {
  void loadInventoryPage(1, true)
})

onMounted(() => {
  if (!inventorySentinel.value) {
    return
  }

  const observer = new IntersectionObserver((entries) => {
    const [entry] = entries

    if (entry?.isIntersecting && hasMoreCars.value && !pending.value) {
      void loadInventoryPage(currentPage.value + 1)
    }
  }, {
    rootMargin: '500px 0px',
  })

  observer.observe(inventorySentinel.value)

  onUnmounted(() => {
    observer.disconnect()
  })
})

const resetFilters = () => {
  filters.manufacturerId = ''
  filters.categoryId = ''
  filters.stock = ''
  filters.yearMin = ''
  filters.yearMax = ''
  filters.priceMin = ''
  filters.priceMax = ''
}

useSeoMeta({
  title: 'Inventory | FieldPro Motor Gallery',
  description: 'Explore available premium vehicles with clear pricing, condition details, and delivery support.',
})
</script>

<template>
  <div>
    <ContentPageHero
      eyebrow="Inventory"
      title="Explore vehicles presented like a true showroom."
      description="Browse listings with manufacturer, model, stock number, odometer, engine, price, images, and categories from the backend."
    />

    <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
      <BaseCard class="mb-8 relative z-20">
        <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-end">
          <div>
            <BaseBadge tone="primary">
              Filter Inventory
            </BaseBadge>
            <h2 class="mt-4 text-2xl font-black text-ink">
              Find the right agricultural vehicle faster.
            </h2>
          </div>
          <BaseButton
            variant="ghost"
            type="button"
            @click="resetFilters"
          >
            Reset Filters
          </BaseButton>
        </div>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
          <BaseSelect
            id="manufacturer-filter"
            v-model="filters.manufacturerId"
            label="Manufacturer"
            placeholder="All manufacturers"
            :options="manufacturerOptions"
          />

          <BaseSelect
            id="category-filter"
            v-model="filters.categoryId"
            label="Category"
            placeholder="All categories"
            :options="categoryOptions"
          />

          <BaseInput
            id="stock-filter"
            v-model="filters.stock"
            label="Stock number"
            type="search"
            placeholder="AG-JD-8370"
          />

          <BaseInput
            id="min-price-filter"
            v-model="filters.priceMin"
            label="Min price"
            type="number"
            min="0"
            placeholder="50000"
          />

          <BaseInput
            id="max-price-filter"
            v-model="filters.priceMax"
            label="Max price"
            type="number"
            min="0"
            placeholder="400000"
          />

          <BaseInput
            id="min-year-filter"
            v-model="filters.yearMin"
            label="Min year"
            type="number"
            min="1900"
            placeholder="2020"
          />

          <BaseInput
            id="max-year-filter"
            v-model="filters.yearMax"
            label="Max year"
            type="number"
            min="1900"
            placeholder="2024"
          />
        </div>
      </BaseCard>

      <div
        v-if="cars.length"
        class="grid gap-6 transition"
        :class="pending && currentPage === 1 ? 'opacity-50 md:grid-cols-2 lg:grid-cols-3' : 'md:grid-cols-2 lg:grid-cols-3'"
      >
        <MachineCard
          v-for="car in cars"
          :key="car.id"
          :car="car"
        />
      </div>

      <EmptyState
        v-else-if="!pending"
        title="No vehicles available"
        description="Inventory from the backend will appear here after listings are added."
      />

      <div
        ref="inventorySentinel"
        class="h-1"
        aria-hidden="true"
      />

      <div
        v-if="pending"
        class="mt-8 flex justify-center"
      >
        <div class="rounded-full border border-white/10 bg-white/[0.06] px-5 py-3 text-sm font-black uppercase tracking-[0.18em] text-primary">
          Loading inventory...
        </div>
      </div>

      <div
        v-else-if="hasMoreCars"
        class="mt-8 flex justify-center"
      >
        <BaseButton
          type="button"
          variant="ghost"
          @click="loadInventoryPage(currentPage + 1)"
        >
          Load More
        </BaseButton>
      </div>
    </section>
  </div>
</template>
