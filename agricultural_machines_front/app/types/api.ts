export interface ApiCollection<T> {
  data: T[]
  links?: Record<string, string | null>
  meta?: PaginationMeta & Record<string, unknown>
}

export interface ApiResource<T> {
  data: T
}

export interface PaginationMeta {
  current_page?: number
  last_page?: number
  per_page?: number
  total?: number
}

export interface Company {
  id: number
  name: string
  address: string
  phone: string
  email: string
  working_times?: WorkingTime[]
}

export interface WorkingTime {
  id: number
  company_id: number
  department: 'company' | 'services'
  day_of_week: number
  opens_at: string | null
  closes_at: string | null
  is_closed: boolean
}

export interface Manufacturer {
  id: number
  name: string
  slug: string
}

export interface MachineModel {
  id: number
  manufacturer_id: number
  name: string
  slug: string
}

export interface Category {
  id: number
  name: string
  slug: string
  description?: string | null
}

export interface CarImage {
  id: number
  car_id: number
  path: string
  url?: string | null
  alt_text?: string | null
  sort_order: number
  is_primary: boolean
}

export interface Car {
  id: number
  manufacturer_id: number
  machine_model_id: number
  year: number
  stock: string
  slug: string
  odometer?: number | null
  engine?: string | null
  price: string
  description?: string | null
  manufacturer?: Manufacturer
  model?: MachineModel
  categories?: Category[]
  images?: CarImage[]
}

export interface Testimonial {
  id: number
  name: string
  location: string
  context: string
  quote: string
  image_url?: string | null
  avatar_url?: string | null
  sort_order: number
  is_featured: boolean
}

export interface TeamMember {
  id: number
  name: string
  role: string
  location?: string | null
  avatar_url?: string | null
  bio?: string | null
  sort_order: number
  is_active: boolean
}
