import type { Car, Category, Company, WorkingTime } from '~/types/api'

export const fallbackWorkingTimes: WorkingTime[] = [
  { id: 1, company_id: 1, department: 'company', day_of_week: 1, opens_at: '09:00', closes_at: '17:00', is_closed: false },
  { id: 2, company_id: 1, department: 'company', day_of_week: 2, opens_at: '09:00', closes_at: '17:00', is_closed: false },
  { id: 3, company_id: 1, department: 'company', day_of_week: 3, opens_at: '09:00', closes_at: '17:00', is_closed: false },
  { id: 4, company_id: 1, department: 'company', day_of_week: 4, opens_at: '09:00', closes_at: '17:00', is_closed: false },
  { id: 5, company_id: 1, department: 'company', day_of_week: 5, opens_at: '09:00', closes_at: '17:00', is_closed: false },
  { id: 6, company_id: 1, department: 'company', day_of_week: 6, opens_at: null, closes_at: null, is_closed: true },
  { id: 7, company_id: 1, department: 'company', day_of_week: 0, opens_at: null, closes_at: null, is_closed: true },
  { id: 8, company_id: 1, department: 'services', day_of_week: 1, opens_at: '08:00', closes_at: '17:00', is_closed: false },
  { id: 9, company_id: 1, department: 'services', day_of_week: 2, opens_at: '08:00', closes_at: '17:00', is_closed: false },
  { id: 10, company_id: 1, department: 'services', day_of_week: 3, opens_at: '08:00', closes_at: '17:00', is_closed: false },
  { id: 11, company_id: 1, department: 'services', day_of_week: 4, opens_at: '08:00', closes_at: '17:00', is_closed: false },
  { id: 12, company_id: 1, department: 'services', day_of_week: 5, opens_at: '08:00', closes_at: '17:00', is_closed: false },
]

export const fallbackCompany: Company = {
  id: 1,
  name: 'FieldPro Agricultural Machines',
  address: '1690 Harvest Road, Green Bay, WI 54311',
  phone: '(920) 263-9137',
  email: 'sales@fieldpromachines.com',
  working_times: fallbackWorkingTimes,
}

export const fallbackCategories: Category[] = [
  { id: 1, name: 'Tractors', slug: 'tractors', description: 'Versatile field and utility tractors.' },
  { id: 2, name: 'Harvesters', slug: 'harvesters', description: 'Combines and harvest equipment.' },
  { id: 3, name: 'Loaders', slug: 'loaders', description: 'Material handling and farm loaders.' },
  { id: 4, name: 'Attachments', slug: 'attachments', description: 'Implements and attachments.' },
]

export const fallbackCars: Car[] = [
  {
    id: 1,
    manufacturer_id: 1,
    machine_model_id: 1,
    year: 2024,
    stock: 'AG00109',
    slug: 'tractors-john-deere-8r-280-2024-ag00109',
    odometer: 214,
    engine: '6.8L Diesel',
    price: '184500.00',
    description: 'Late-model row crop tractor with premium cab, loader prep, guidance-ready electronics, and fresh service.',
    manufacturer: { id: 1, name: 'John Deere', slug: 'john-deere' },
    model: { id: 1, manufacturer_id: 1, name: '8R 280', slug: '8r-280' },
    categories: [fallbackCategories[0]],
    images: [],
  },
  {
    id: 2,
    manufacturer_id: 2,
    machine_model_id: 2,
    year: 2022,
    stock: 'AG00134',
    slug: 'harvesters-case-ih-axial-flow-7150-2022-ag00134',
    odometer: 890,
    engine: '7.8L Diesel',
    price: '229900.00',
    description: 'High-capacity combine with inspected threshing components, clean cab, and field-ready tires.',
    manufacturer: { id: 2, name: 'Case IH', slug: 'case-ih' },
    model: { id: 2, manufacturer_id: 2, name: 'Axial-Flow 7150', slug: 'axial-flow-7150' },
    categories: [fallbackCategories[1]],
    images: [],
  },
  {
    id: 3,
    manufacturer_id: 3,
    machine_model_id: 3,
    year: 2021,
    stock: 'AG00152',
    slug: 'loaders-jcb-loadall-541-70-2021-ag00152',
    odometer: 642,
    engine: '4.5L Diesel',
    price: '78500.00',
    description: 'Compact telehandler with enclosed cab, auxiliary hydraulics, and excellent visibility.',
    manufacturer: { id: 3, name: 'JCB', slug: 'jcb' },
    model: { id: 3, manufacturer_id: 3, name: 'Loadall 541-70', slug: 'loadall-541-70' },
    categories: [fallbackCategories[2]],
    images: [],
  },
]
