<template>
    <div>
    <el-form ref="form" label-width="120px" class="w-50">
        <h3>Search form</h3>
        <el-form-item label="Name">
            <el-input v-model="name"></el-input>
        </el-form-item>
        <el-form-item label="Count bedrooms">
            <el-input v-model.number="bedrooms"></el-input>
        </el-form-item>
        <el-form-item label="Count bathrooms">
            <el-input v-model.number="bathrooms"></el-input>
        </el-form-item>
        <el-form-item label="Count storeys">
            <el-input v-model.number="storeys"></el-input>
        </el-form-item>
        <el-form-item label="Count garages">
            <el-input v-model.number="garages"></el-input>
        </el-form-item>
        <el-form-item label="Price">
            <el-input v-model.number="priceTo" placeholder="From"></el-input> -
            <el-input v-model.number="priceTo" placeholder="To"/>

        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="getHouses">Search</el-button>
        </el-form-item>
    </el-form>
    <el-table
        :data="houses"
        style="width: 100%"
        :empty-text="'No data'">
        <el-table-column
            prop="name"
            label="Name"
            width="180">
        </el-table-column>
        <el-table-column
            prop="price"
            label="Price"
            width="180">
        </el-table-column>
        <el-table-column
            prop="countBathrooms"
            label="Bathrooms">
        </el-table-column>
        <el-table-column
            prop="countBedrooms"
            label="Bedrooms">
        </el-table-column>
        <el-table-column
            prop="countGarages"
            label="Garages">
        </el-table-column>
        <el-table-column
            prop="countStoreys"
            label="Storeys">
        </el-table-column>
    </el-table>
    </div>
</template>

<script>
export default {
    data() {
        return {
                name: '',
                bedrooms: null,
                bathrooms: null,
                storeys: null,
                garages: null,
                priceFrom: null,
                priceTo: null,
                houses: [],

        }
    },
    methods: {
        getHouses() {
           axios.get(`/api/house/search?name=${this.name}&bedrooms=${this.bedrooms}&bathrooms=${this.bathrooms}
           &storeys=${this.storeys}&garages=${this.garages}&priceFrom=${this.priceFrom}&priceTo=${this.priceTo}`)
            .then(({data}) => {
                console.log(data);
                this.houses = data.result;
            })

        }
    },
    created() {
        this.getHouses();
    }
}

</script>
