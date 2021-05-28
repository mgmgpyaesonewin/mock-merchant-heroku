<template>
    <div class="mt-4">
        <label for="initiator-msisdn">Initiator Msisdn</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="checkbox" name="initiator_msisdn_checkbox" v-model="include" class="mr-1">
                    <span>Include Msisdn</span>
                </div>
            </div>
            <input type="text" name="initiator_msisdn" class="form-control" :disabled="!include" id="initiator-msisdn" aria-describedby="initiator-msisdn" placeholder="Enter phone number">
        </div>
    </div>
</template>

<script>
export default {
    name: "MsisdnInput",
    data() {
        return {
            include: false,
            msisdn: ''
        }
    }
}
</script>

<style scoped>

</style>
