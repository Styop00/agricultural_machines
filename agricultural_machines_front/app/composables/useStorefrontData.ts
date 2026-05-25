import { fallbackCars, fallbackCategories, fallbackCompany } from '~/utils/fallback-data'
import type { Car, Category, Company, Manufacturer, TeamMember, Testimonial } from '~/types/api'

export const useStorefrontData = () => {
  const api = useApi()

  const loadCompany = () => useAsyncData('company-profile', async () => {
    try {
      const response = await api.getCollection<Company>('companies', { per_page: 1 })

      return response.data[0] ?? fallbackCompany
    } catch {
      return fallbackCompany
    }
  })

  const loadCars = (key = 'cars', params: Record<string, string | number | undefined> = { per_page: 12 }) => useAsyncData(key, async () => {
    try {
      const response = await api.getCollection<Car>('cars', params)

      return response.data
    } catch {
      return fallbackCars
    }
  })

  const loadCar = (slug: string) => useAsyncData(`car-${slug}`, async () => {
    try {
      const response = await api.getResource<Car>(`cars/${slug}`)

      return response.data
    } catch {
      return fallbackCars.find((car) => car.slug === slug)
        ?? fallbackCars.find((car) => car.id === Number(slug))
        ?? fallbackCars[0]
    }
  })

  const loadCategories = () => useAsyncData('categories', async () => {
    try {
      const response = await api.getCollection<Category>('categories', { per_page: 100 })

      return response.data
    } catch {
      return fallbackCategories
    }
  })

  const loadManufacturers = () => useAsyncData('manufacturers', async () => {
    try {
      const response = await api.getCollection<Manufacturer>('manufacturers', { per_page: 100 })

      return response.data
    } catch {
      return []
    }
  })

  const loadTestimonials = () => useAsyncData('testimonials', async () => {
    try {
      const response = await api.getCollection<Testimonial>('testimonials', { per_page: 24, featured: 1 })

      return response.data
    } catch {
      return []
    }
  })

  const loadTeamMembers = () => useAsyncData('team-members', async () => {
    try {
      const response = await api.getCollection<TeamMember>('team-members', { per_page: 24, active: 1 })

      return response.data
    } catch {
      return []
    }
  })

  return {
    loadCompany,
    loadCars,
    loadCar,
    loadCategories,
    loadManufacturers,
    loadTestimonials,
    loadTeamMembers,
  }
}
