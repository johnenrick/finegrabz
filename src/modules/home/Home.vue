<template>
  <div>
    <section class="success">
      <div class="container " style="">
          <div class="row ">
              <div class="col-lg-12 text-center">
                  <h3>Menu of the Week</h3>
                  <hr class="star-light">
              </div>
          </div>

          <div class="row text-center" v-for="productByDay in productListByDay" >
              <div class="col-lg-8 col-lg-offset-2">
                  <h4>{{productByDay['day']}}</h4>
                  <p v-for="product in productByDay['products']">
                    {{product['description']}}
                  </p>
              </div>
          </div>
      </div>
    </section>

    <div class="container no-container-padding">
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Office Lunch
                  <small>Refreshing and exciting lunches</small>
              </h1>
          </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="alert alert-info">
            <strong>Delivery Schedule and Location!</strong><br>
            Delivery Time: Between 11:45~12:00 noon from Tuesday till Thursday
            <br>
            Collection will be at 80 Boon Keng Road, Continental Lobby area
          </div>
        </div>
      </div>
      <template v-for="productByDay in productListByDay" >
        <h3>{{productByDay['day']}}</h3>
        <hr style="border-top: 1px solid #18bc9c;"/>
        <div v-for="product in productByDay['products']" class="row">
            <div class="col-md-7">
                <img class="img-responsive img-thumbnail" v-bind:src="IMAGE_URL + product['image']" alt="">
            </div>
            <div class="col-md-5" style="">
                <h3>{{product['description']}}</h3>
                <p>{{product['details']}}</p>
                <p style="font-style:italic">Available with:<br>
                  <span v-if="product['rice'] * 1">&nbsp;&nbsp;Rice - ${{(product['rice'] * 1).toFixed(2)}}<br></span>
                  <span v-if="product['barley'] * 1" >&nbsp;&nbsp;Barley - ${{(product['barley'] * 1).toFixed(2)}}<br></span>
                  <span v-if="product['basmati_rice'] * 1" >&nbsp;&nbsp;Basmati - ${{(product['basmati_rice']*1).toFixed(2)}}<br></span>
                </p>
                <div class="form-group text-center">
                  <a @click="showModal=true; orderProductID=product['id']" class="btn btn-success" >Place Order Now <span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>
        </div>
      </template>
    </div>
    <modal :show_modal="showModal" v-on:change-state="modalChangeState">
      <div slot="header">
        <button
            @click="showModal = false"
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">
          Order Form
        </h4>
      </div>
      <div slot="body">
        <div class="row">
          <div class="col-sm-12">
            <div class="col-sm-12">
              <div class="alert alert-info">
                <strong>Delivery Schedule and Location!</strong><br>
                Delivery Time: Between 11:45~12:00 noon from Tuesday till Thursday
                <br>
                Collection will be at 80 Boon Keng Road, Continental Lobby area
              </div>
            </div>
            <div v-if="errorMessage" class="col-sm-12">
              <div class="alert alert-danger">
                <strong>Warning!</strong>
                <div v-html="errorMessage">

                </div>
              </div>
            </div>
            <form class="form-horizontal" v-if="orderProductID">
              <div class="form-group">
                <label class="col-sm-5 control-label">Name</label>
                <div class="col-sm-7">
                  <input v-model="orderForm.name" v-bind:disabled="orderResponse || orderSending" type="text" class="form-control"  placeholder="Name">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-5 control-label">Email</label>
                <div class="col-sm-7">
                  <input v-model="orderForm.email" v-bind:disabled="orderResponse || orderSending" type="email" class="form-control"  placeholder="Email">
                  <span class="help-block">An order confirmation will be sent with this email</span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-5 control-label">Mobile Number</label>
                <div class="col-sm-7">
                  <input v-model="orderForm.mobile_number" v-bind:disabled="orderResponse || orderSending" type="text" class="form-control"  placeholder="Mobile Number">
                  <span id="helpBlock" class="help-block">We will inform you as soon as your order has arrived through sms or group chat</span>
                </div>
              </div>
              <div class="form-group " v-if="productList[orderProductID]['rice'] * 1">
                <label  class="col-sm-5 control-label">Order with Rice</label>
                <div class="col-sm-7">
                  <select v-bind:disabled="orderResponse || orderSending" v-model="orderForm.rice_option" class="form-control" >
                    <option value="null">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
              </div>

              <div class="form-group" v-if="productList[orderProductID]['barley'] * 1">
                <label  class="col-sm-5 control-label">Order with Barley </label>
                <div class="col-sm-7">
                  <select v-bind:disabled="orderResponse || orderSending" v-model="orderForm.barley_option" class="form-control" >
                    <option value="null">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
              </div>
              <div class="form-group " v-if="productList[orderProductID]['basmati_rice'] * 1">
                <label  class="col-sm-5 control-label">Order with Basmati Rice</label>
                <div class="col-sm-7">
                  <select v-bind:disabled="orderResponse || orderSending" v-model="orderForm.basmati_option" class="form-control" >
                    <option value="null">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
              </div>
              <div class="form-group ">
                <label  class="col-sm-5 control-label">Payment Method</label>
                <div class="col-sm-7">
                  <select v-bind:disabled="orderResponse || orderSending" v-model="orderForm.payment_method" class="form-control" >
                    <option value="null">Select Payment</option>
                    <option value="1">DBS Paylah!</option>
                    <option value="2">DBS/POSB iBanking Transfer</option>
                    <option value="3">ADVANCE CASH PAYMENT</option>
                  </select>
                </div>
              </div>
              <div class="form-group text-center">
                <button v-if="!orderResponse" @click="sendOrder" v-bind:disabled="orderSending" class="btn btn-success" >
                  <span v-if="!orderSending">Send Order <i class="fa fa-send" aria-hidden="true"></i></span>
                  <span v-else>Sending...</span>
                </button>
                <span v-else class="text-success">Your order has been sent. You will receive a confirmation email shortly</span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </modal>
  </div>
</template>
<script>
  import Vue from 'vue'
  export default{
    name: '',
    create(){

    },
    components: {
      'modal': require('../../components/modal/Modal.vue')
    },
    mounted(){
      this.retrieveProducts()
    },
    data(){
      return {
        productListByDay: {},
        productList: {},
        orderProductID: 0,
        showModal: false,
        orderForm: {
          product_id: 0,
          name: null,
          email: null,
          mobile_number: null,
          rice_option: null,
          barley_option: null,
          basmati_option: null,
          payment_method: null
        },
        orderSending: false,
        orderResponse: false,
        errorMessage: false
      }
    },
    props: {
    },
    methods: {
      sendOrder(){
        this.orderSending = true
        let param = this.orderForm
        param.product_id = this.orderProductID
        param.day = this.productList[this.orderProductID]['day']
        this.errorMessage = false
        this.APIRequest('product_order/create', param, (response) => {
          if(response.data){
            this.orderResponse = true
          }else{
            this.orderResponse = false

            this.errorMessage = ''
            if(response.error.status === 100){
              for(var x in response.error.message){
                this.errorMessage += '<i class="fa  fa-chevron-right" aria-hidden="true"></i> ' + response.error.message[x][0] + '<br>'
              }
            }
          }
          this.orderSending = false
        }, () => {
          this.orderSending = false
        })
      },
      retrieveProducts(){
        let param = {
          condition: [
            {
              column: 'status',
              value: 1
            }
          ],
          sort: {
            day: 'asc'
          }
        }
        this.APIRequest('product/retrieve', param, (response) => {
          this.productListByDay = {}
          this.productList = {}
          for(let x = 0; x < response['data'].length; x++){
            if(typeof this.productListByDay[response['data'][x]['day']] === 'undefined'){
              Vue.set(this.productListByDay, response['data'][x]['day'], {
                products: [],
                day: this.convertDay(response['data'][x]['day'])
              })

            }
            this.productListByDay[response['data'][x]['day']]['products'].push(response['data'][x])
            if(this.productListByDay[response['data'][x]['day']]['image'] === ''){
              Vue.set(this.productListByDay[response['data'][x]['day']], 'image', response['data'][x]['image'])
            }
            if(this.productListByDay[response['data'][x]['day']]['details'] === ''){
              Vue.set(this.productListByDay[response['data'][x]['day']], 'details', response['data'][x]['details'])
            }

            Vue.set(this.productList, response['data'][x]['id'], response['data'][x])
          }
          console.log(this.productListByDay)
        })
      },
      modalChangeState(value){
        this.showModal = value
      },
      convertDay(value){
        let days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
        return days[value - 1]
      }
    }

  }
</script>
<style scoped>
.half-rule {
  margin-left: 0;
  text-align: left;
  width: 50%;
}
</style>
