<template>
    <div class="container mt-3">
        <div class="jumbotron">
            <form>
                <label for="Merchant ID"></label>
                <label for="trnx">Transaction ID:</label>
                <input type="text" />
                <label for="trnx">Transaction Date:</label>
                <input type="date" />
                <button class="btn btn-success" @click="checkStatus">Status Check</button>
                <button class="btn btn-primary">Reversed Transaction</button>
            </form>
            <pre>{{ json | pretty }}</pre>
        </div>
    </div>
<!--    <div class="container">-->
<!--        <div class="row justify-content-center">-->
<!--            <div class="col-md-8">-->
<!--                <div class="card">-->
<!--                    <div class="card-header">Example Component</div>-->

<!--                    <div class="card-body">-->
<!--                        I'm an example component.-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
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
            jsonstr: '{"id":1,"name":"A green door","price":12.50,"tags":["home","green"]}',
            json: {}
        }
    },
    methods: {
        checkStatus() {
            axios.post(`https://testapi.wavemoney.io:8100/utility/tnxstatus`, )
                .then((res) => {
                    this.json = res.data;
                })
        }
    },
    filters: {
        pretty: function(value) {
            return JSON.stringify(JSON.parse(value), null, 2);
        }
    }
}
</script>

<style scoped>

</style>
