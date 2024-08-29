<template>
    <div v-for="field in fields" :key="field" class="mb-3">
        <label :for="`additional_field_${field}`" class="form-label">Additional Field {{ field }}</label>
        <input
            type="text"
            class="form-control"
            :id="`additional_field_${field}`"
            :placeholder="`Enter additional info for Field ${field} here`"
            v-model="formData[`field_${field}`]"
        />
    </div>
</template>

<script>
export default {
    name: "AdditionalFields",
    data() {
        return {
            fields: [3, 4, 5],
            formData: {
                field_3: '',
                field_4: '',
                field_5: ''
            }
        }
    }
}
</script>
