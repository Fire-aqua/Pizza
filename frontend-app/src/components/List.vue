<template>
  <div>
    <!-- фильтрация по ингредиентам -->
    <v-row>      
      <v-card
      class="mx-3 my-3"
      min-width=330
      v-for="goods in groupedGoods"
      :key="goods[0].display_name_ru">
        <v-card-title>
          {{goods[0].display_name_ru}}
        </v-card-title>
        <v-card-text
          v-for="good in goods"
          :key="good.id">          
            <v-row>
              <v-col>
                <div>Размер: {{good.size}}</div>                
                {{ good.price }}$
              </v-col>
              <v-col>
                <v-btn                 
                @click="addGoodToCart(
                  good.id,
                  good.display_name_ru,
                  good.size,
                  good.price,
                  good.type)">
                  +
                </v-btn>
              </v-col>
            </v-row>
        </v-card-text>
      </v-card>
    </v-row>    
    <v-row
    v-if="orderElements[0]"
    class="mx-auto my-3"
    style="width: 200px;">
      <v-btn 
      x-large
      color="orange"
      @click="showOrder=true">
      Сделать заказ</v-btn>
    </v-row>    
    <v-row
    v-else    
    class="mx-auto my-3"
    style="width: 200px;">
      <v-btn 
      x-large
      disabled>
      Сделать заказ</v-btn>
    </v-row>       
  <v-divider/>
    <v-card
    v-if="showOrder">
      <v-card-title>
        Ваш заказ
      </v-card-title>
      <v-card-text>
        <v-row>
          <v-col>
            <b>Позиция</b>
          </v-col>
          <v-col>
            <b>Количество</b>
          </v-col>
          <v-col>
            <b>Цена</b>
          </v-col>
          <v-col>
            <b>Топпинги для пицц</b>
          </v-col>
        </v-row>
        <v-row          
        v-for="orderElement in orderElements"          
        :key="orderElement.id">
          <v-col>
            {{ orderElement.name }}<br>
            Размер: {{ orderElement.size }}
          </v-col>
          <v-col>
            {{ orderElement.count }}
            <v-btn
            class="mx-6 my-3"
            @click="orderElement.count ++">
              +
            </v-btn>
            <v-btn
            v-if="orderElement.count>1"
            class="mx-6 my-3"
            @click="orderElement.count --">
              -
            </v-btn>
            <v-btn
            v-else
            class="mx-6 my-3"
            @click="deleteOrderElement(orderElement)">
              х
            </v-btn>
          </v-col>
          <v-col>
            {{ getOrderElementPrice(orderElement) }}
          </v-col>
          <v-col
          v-if="orderElement.good_type=='pizza'">
            <v-autocomplete
            v-model="orderElement.toppings"
            :items="toppings"
            label="Ко всем пиццам этого типа"
            multiple
            item-text='display_name_ru'
            outlined
            return-object
            dense
            ></v-autocomplete>
          </v-col>            
          <v-col
          v-else/>
        </v-row>
        <v-row>
          <v-col>
            <h2>Всего: {{ totalSum }}$</h2>
          </v-col>
        </v-row>   
        <v-form>
          <v-row>
            <v-col>
              <v-text-field
              v-model="customer.fio"
              label="Фамилия, имя"
              placeholder="Фамилия, имя"
              ></v-text-field>
            </v-col>     
            <v-col>
              <v-text-field
              v-model="customer.phone"
              label="Телефон"
              placeholder="Телефон"
              ></v-text-field>
            </v-col>
            <v-col>
              <v-text-field
              v-if="homeOrder==true"
              v-model="customer.street"
              label="Улица"
              placeholder="Улица"
              ></v-text-field>
            </v-col>
            <v-col>
              <v-text-field
              v-if="homeOrder==true"
              v-model="customer.house"
              label="Номер дома"
              placeholder="Номер дома"
              ></v-text-field>
            </v-col>
            <v-col>
              <v-text-field
              v-if="homeOrder==true"
              v-model="customer.flat"
              label="Квартира/комната"
              placeholder="Квартира/комната"
              ></v-text-field>
            </v-col>
          </v-row>          
          <v-row>
            <v-btn 
            class="mx-auto my-3"
            v-if="homeOrder==false"
            @click="homeOrder=true">
              Заказ на дом
            </v-btn>
            <v-btn
            v-else
            class="mx-auto my-3"
            @click="homeOrder=false, customer = {
              fio: customer.fio,
              phone: customer.phone,
              street: '',
              house: '',
              flat: ''}">
              Я передумал, заберу в ресторане
            </v-btn>
          </v-row>
        </v-form>
        <v-row>
          <v-btn
          class="mx-auto my-3"
          style="width: 200px;"
          color="orange"
          x-large
          @click="sendToServer(
            orderElements,
            customer)">
            Оформить заказ
          </v-btn>
        </v-row>
      </v-card-text>
    </v-card>
    <v-card
    v-if="orderCard==true">
      <v-card-text
      class="mx-auto my-3">
        <div class="my-3">
          <h1>Ваш номер заказа: {{ orderNumber}}</h1>
        </div>
        <div class="my-3">
          <h3>В течение нескольких минут с Вами свяжутся для подтверждения и уточнения заказа.</h3>
        </div>
        <h3>Ваш заказ:</h3>
        <v-list>
          <v-row>
            <v-col>
              <b>Блюдо</b>
            </v-col>
            <v-col>
              <b>Количество</b>
            </v-col>
            <v-col>
              <b>Стоимость</b>
            </v-col>
            <v-col>
              <b>Топпинги</b>
            </v-col>
          </v-row>
          <v-row
          v-for="orderElement in orderElements"          
          :key="orderElement.id">          
            <v-col>
              <v-list-item-title>{{ orderElement.name }}</v-list-item-title>
              Размер: {{ orderElement.size }}
            </v-col>
            <v-col>
              {{ orderElement.count }}
            </v-col>
            <v-col>
              {{ getOrderElementPrice(orderElement) }}$
            </v-col>
            <v-col
            v-if="orderElement.toppings[0]">
              <v-list
              v-for="topping in orderElement.toppings"
              :key="topping.id">
                <v-list-item-content>
                  <v-list-item-title v-text="topping.display_name_ru"/>
                </v-list-item-content>
              </v-list>
            </v-col>
            <v-col
            v-else>
            </v-col>
          </v-row>
        </v-list>
        <div>
          <h2>Всего: {{ totalSum }}$</h2>
        </div>
        <br>
        <v-divider/>
        <br>
        <div>
          Видите ошибку? Свяжитесь с нами!
        </div>
          <div>
            Имя: {{ customer.fio }}
          </div>
          <div>
            Телефон: {{ customer.phone }}
          </div>
          <div v-if="homeOrder==true">
            <div>
              улица: {{ customer.street }}
            </div>
            <div>
              Дом: {{ customer.house }}
            </div>
            <div>
              Квартира: {{ customer.flat }}
            </div>
          </div>
      </v-card-text>
    </v-card>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { Good, OrderElement, Ingredient, Topping } from "../types";
import axios from "axios";

@Component({})
export default class List extends Vue {
  toppings: Topping[] = []
  groupedGoods: Good[] = []
  ingredients: Ingredient[] = []
  orderElements: OrderElement[] = []
  orderNumber: number | null = null
  homeOrder = false
  showOrder = false
  orderCard = false
  customer = {
    fio: "",
    phone: "",
    street: "",
    house: "",
    flat: ""}

  mounted() {
    this.getGoodsFromServer()
    this.getIngredientsFromServer()
    this.getToppingsFromServer()
  }

  getGoodsFromServer() {
    axios.get("/goods").then((response) => {
      this.groupedGoods = response.data
    });
  }

  getIngredientsFromServer() {
    axios.get("/ingredients").then((response) => {
      this.ingredients = response.data
    });
  }

  getToppingsFromServer() {
    axios.get("/toppings").then((response) => {
      this.toppings = response.data
    });
  }

  addGoodToCart(goodId, goodName, goodSize, goodPrice, goodType) {    
    let existanceOrderElement = this.orderElements.find((orderElement) => {
      return orderElement.good_id === goodId;
    })
    if (existanceOrderElement) {
      existanceOrderElement.count ++
    }
    else {
      this.orderElements.push({
        name: goodName,
        count: 1,
        price: goodPrice,
        size: goodSize,
        good_type: goodType,
        good_id: goodId,
        toppings: []
      })
    }
  }

  getOrderElementPrice(orderElement: OrderElement): number {
    return orderElement.count * orderElement.price  +
    orderElement.count * orderElement.toppings.reduce((sum, topping) => sum+topping.price, 0) 
  }
  
  deleteOrderElement(deletingElement) {
    let delIndex = this.orderElements.findIndex((orderElement) => deletingElement==orderElement)
    this.orderElements.splice(delIndex, 1)
    this.orderElements[0] ? this.showOrder=true : this.showOrder=false
  }

  get totalSum(): number {
    if(this.orderElements.length) {
      return this.orderElements.reduce((sum, orderElement): number => (
        sum + this.getOrderElementPrice(orderElement)
      ), 0)
    }
    return 0
  }

  sendToServer() {
    if(this.homeOrder == false 
    && (this.customer.fio==""
    || this.customer.phone=="")) {
      return alert("Пожалуйста, заполните данные для связи!")
    }
    else if (this.homeOrder == true 
    && (this.customer.fio==""
    || this.customer.phone==""
    || this.customer.street==""
    || this.customer.house==""
    || this.customer.flat=="")) {
      return alert("Пожалуйста, заполните данные для связи и доставки!")
    }
    else {
      axios.post('/send-order', {
        orderElements: this.orderElements,
        orderCustomer: this.customer})
        .then((response) => {
          this.orderNumber = response.data.orderNumber
          this.customer = {
            fio: response.data.fio,
            phone: response.data.phone,
            street: response.data.street,
            house: response.data.house,
            flat: response.data.flat}
        })
        .catch(function (error) {console.log(error);
        });
      this.showOrder = false
      this.orderCard = true
    }
  }
}
</script>
