<template>
  <div>
    
    <v-data-table
      :headers="orderHeaders"
      :items="orders"
      :expanded.sync="expanded"
      show-expand      
      :loading="orderLoad"
    >
      <template v-slot:expanded-item="{ headers, item: order }">
      <td :colspan="headers.length">
          <v-data-table
            :headers="orderElementsHeaders"
            :items="order.order_elements"
            show-select
            v-model="selected[order.id]"
            hide-default-footer>
          <template
          v-slot:item.ingredients="{ item: order_elements }">
            <v-list>
              <ul>
                <li
                v-for="ingredient in order_elements.ingredients"
                :key="ingredient.id">
                {{ ingredient.display_name_ru }}
                </li>
              </ul>
            </v-list>
          </template>
          </v-data-table>
        </td>
      </template>
      <template v-slot:item.orderSum="{ item: order }">
        {{ orderSum(order) }}
      </template>
      <template
      v-slot:item.action="{ item: order }">
        <v-btn
        :disabled="isBlocked(order)"
        @click="deletingOrderModal(order.id)">
          Удалить
        </v-btn>
      </template>  
      <template v-slot:top>
        <v-btn
        @click="downloadOrders()">
          Скачать отчет по заказам
        </v-btn>
      </template>    
    </v-data-table>
    <v-dialog
    v-model="showDeletingModal"
    max-width="500">
      <v-card>
        <v-card-title class="headline">
          Вы точно хотите удалить заказ?
        </v-card-title>
        <v-card-actions>
          <v-btn
          text
          @click="showDeletingModal = false">
            Оставить
          </v-btn>
          <v-btn
          text
          @click="deleteOrder()" >
            Удалить
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import axios from "axios";
import Component from "vue-class-component";

@Component({})
export default class Admin extends Vue {
  orders = []
  orderLoad = false
  showDeletingModal = false
  deletingOrderId = null
  expanded = []
  selected = {}
  orderElementsHeaders = [
    { text: 'Товар', value: 'good.display_name_ru' },
    { text: 'Размер', value: 'size' },
    { text: 'Количество', value: 'count' },
    { text: 'Топпинги', value: 'ingredients' }
  ]
  orderHeaders = [
    { text: 'Номер заказа', value: 'id' },
    { text: 'Имя', value: 'customer.fio' },
    { text: 'Телефон', value: 'customer.phone' },
    { text: 'Улица', value: 'customer.street' },
    { text: 'Дом', value: 'customer.house' },
    { text: 'Квартира', value: 'customer.flat' },
    { text: 'Цена', value: 'total_sum' },
    { text: '', value: 'action' }    
  ]

  mounted() {
    this.getOrdersFromServer()
  }

  async getOrdersFromServer() {
    this.orderLoad = true
    await axios.get("/orders")
    .then((response) => {
      this.orders = response.data  
    })
    .catch(() => alert('Пожалуйста, авторизуйтесь для просмотра'));
    this.orderLoad = false
  }

  downloadOrders() {
    axios.get('/download-order', { responseType: 'blob' })
    .then(response => {
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', 'orders.pdf');
      document.body.appendChild(link);
      link.click();
    })
  }

  orderSum(order): number {
    return order.order_elements.reduce((acc, order_element) => {
        const ingredientSum = order_element.ingredients.reduce((acc2, ingredient) => 
        {
          return acc2 + ingredient.price
        }, 0)
        return acc + (order_element.count * (order_element.good.price + ingredientSum))
      }, 0 
    )  
  };

  isBlocked(order) {
    return order.order_elements.length !== this.selected[order.id]?.length
  }

  deletingOrderModal(orderId) {
    this.showDeletingModal = true
    this.deletingOrderId = orderId
  }

  deleteOrder() {
    axios.post("/delete-order", {
      id: this.deletingOrderId
      })
    .then(() => {
      this.showDeletingModal = false
      const delIndex = this.orders.findIndex((order) => {
        return order.id == this.deletingOrderId        
      })
      if(delIndex != -1) {
        this.orders.splice(delIndex, 1)
      }
      this.deletingOrderId = null
      })
  }  
}
</script>