import type { ApiCollection, ApiResource } from '~/types/api'

export const useApi = () => {
  const config = useRuntimeConfig()
  const baseURL = config.public.apiBase

  const getCollection = async <T>(path: string, params?: Record<string, string | number | undefined>) => {
    return await $fetch<ApiCollection<T>>(path, {
      baseURL,
      params,
    })
  }

  const getResource = async <T>(path: string) => {
    return await $fetch<ApiResource<T>>(path, {
      baseURL,
    })
  }

  return {
    getCollection,
    getResource,
  }
}
