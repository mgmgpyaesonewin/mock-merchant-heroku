<template>
    <div class="pt-1">
        <div class="jumbotron">
            <div class="form-row">
                <div class="col">
                    <label for="trnx">Transaction ID:</label>
                    <input type="text" class="form-control" v-model="trnxId">
                </div>
                <div class="col">

                    <label for="trnx">Transaction Date</label>
                    <input type="date" class="form-control" v-model="trnxDate">
                </div>
            </div>
            <div class="mt-4 pb-1">
                <button class="btn btn-success" @click="checkStatus">Status Check</button>
                <button class="btn btn-primary" @click="reversal">Reversed Transaction</button>

            </div>
            <pre v-show="isShow">{{ json | pretty }}</pre>
        </div>
    </div>
</template>

<script>
export default {
    name: "PaymentInfoForm",
    data() {
        return {
            merchantId: '9262431',
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
                this.isShow = true;
                this.json = res.data;
            }).catch((error) => {
                this.isShow = true;
                this.json = error;
            });
        },
        reversal() {
            axios.post(`/reversal/transaction`, {
                "merchant": this.merchantId,
                "tnxID": this.trnxId,
                "tnxDate": this.trnxDate,
                "noti": "ON",
                "bonus": "Y",
                "fee": "Y"
            }).then((res) => {
                this.isShow = true;
                this.json = res.data;
            }).catch((error) => {
                this.isShow = true;
                this.json = error;
            });
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
