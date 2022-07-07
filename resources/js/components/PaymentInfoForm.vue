<template>
    <div class="container mt-3">
        <div class="jumbotron">
            <label for="Merchant ID"></label>
            <label for="trnx">Transaction ID:</label>
            <input type="text" v-model="trnxId"/>
            <label for="trnx">Transaction Date:</label>
            <input type="date" v-model="trnxDate"/>
            <button class="btn btn-success" @click="checkStatus">Status Check</button>
            <button class="btn btn-primary">Reversed Transaction</button>
            <pre v-show="isShow">{{ json | pretty }}</pre>
        </div>
    </div>
</template>

<script>
export default {
    name: "PaymentInfoForm",
    data() {
        return {
            merchantId: '9652554',
            trnxId: '',
            trnxDate: '',
            channel: 'pww',
            isShow: false,
            json: ''
        }
    },
    methods: {
        checkStatus() {

            axios.post(`/paymentInfo`, {
                "merchant": this.merchantId,
                "referenceId": this.trnxId,
                "txnDate": this.trnxDate,
                "channel": "pww"
            }).then((res) => {
                console.log(res);
                this.isShow=true;
                this.json = res.data;
            })
        }
    },
    filters: {
        pretty: function (value) {
            return JSON.stringify(value, null, 2);
        }
    }
}
</script>

<style scoped>

</style>
