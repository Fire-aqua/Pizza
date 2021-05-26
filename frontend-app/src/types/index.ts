type Good = {
  id: number
  name: string
  display_name_ru: string
  display_name_en: string
  price: number
  size: number
  type: string
  created_at: string
  updated_at: string
}

type OrderElement = {
  name: string
  count: number
  price: number
  size: number
  good_type: string
  good_id: string
  toppings: Topping[]
}

type Ingredient = {
  id: number
  name: string
  display_name_ru: string
  display_name_en: string
  is_topping: boolean
  price: number
  created_at: string
  updated_at: string
}

type Topping = {
  id: number
  name: string
  price: number
  count: number
}

type Order = {
  id: number
  orderElements: OrderElement
  orderNumber: number
  customerId: number
  created_at: string
  updated_at: string
}