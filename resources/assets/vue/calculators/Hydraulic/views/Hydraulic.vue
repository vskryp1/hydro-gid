<template>
    <div class="calculator-page__inner">
        <div class="calculator-page__input">
            <div class="calculator-page__input-title">
                Гидроцилиндр
            </div>
            <div class="calculator-page__input-text">
                Введите параметры вашего <br> гидроцилиндра:
            </div>
            <div class="calculator-page__input-item">
                <label for="diameterPiston">Диаметр поршня</label>
                <div>
                    <input id="diameterPiston" type="number" min="0" v-model="diameter_piston"
                           @change="changeDiameterPiston"/>
                    <span>мм</span>
                </div>
            </div>
            <div class="red" v-if="hideWarningText">
                <p>Диаметр штока не должен превышать диаметр поршня</p>
            </div>
            <div class="calculator-page__input-item">
                <label for="diameterStock">Диаметр штока</label>
                <div>
                    <input id="diameterStock" type="number" min="0" v-model="diameter_stock"/>
                    <span>мм</span>
                </div>
            </div>
            <div class="calculator-page__input-item">
                <label for="strokeLength">Длина хода</label>
                <div>
                    <input id="strokeLength" type="number" min="0" v-model="stroke_length"/>
                    <span>мм</span>
                </div>
            </div>
            <div class="calculator-page__input-item">
                <label class="calculator-page__label" for="oilConsumption">Расход масла</label>
                <div>
                    <input id="oilConsumption" type="number" min="0" v-model="oil_consumption"
                           @change="changeOilConsumption"/>
                    <span>л/мин</span>
                </div>
            </div>
            <div class="calculator-page__input-item">
                <label for="extensionTime" class="calculator-page__label">Время выдвижения</label>
                <div>
                    <input id="extensionTime" type="number" min="0" v-model="extension_time"
                           @change="changeExtensionTime"/>
                    <span>с</span>
                </div>
            </div>
            <div class="calculator-page__input-item">
                <label class="calculator-page__label">Скорость выдвижения</label>
                <div>
                    <span class="s-number">{{ extensionSpeed }}</span>
                    <span>см/с</span>
                </div>
            </div>
            <div class="calculator-page__input-item">
                <label class="calculator-page__label" for="pressure">Давление</label>
                <div>
                    <input id="pressure" type="number" min="0" v-model="pressure"
                           @change="changePressure"/>
                    <span>бар</span>
                </div>
            </div>
            <div class="calculator-page__input-item">
                <label class="calculator-page__label" for="extensionForce">Усилие выдвижения</label>
                <div>
                    <input id="extensionForce" type="number" min="0" v-model="extension_force"
                           @change="changeExtensionForce"/>
                    <span>кг</span>
                </div>
            </div>
        </div>

        <div class="calculator-page__conclusion">
            <div class="calculator-page__conclusion-inner">
                <div class="calculator-page__conclusion-title">
                    Расчитанные характеристики
                </div>
                <div class="calculator-page__conclusion-item">
                    <div class="calculator-page__conclusion-text">
                        Площадь поршневой области
                    </div>
                    <div class="calculator-page__conclusion-number">
                        {{ squarePiston }} см2
                    </div>
                </div>
                <div class="calculator-page__conclusion-item">
                    <div class="calculator-page__conclusion-text">
                        Площадь штоковой области
                    </div>
                    <div class="calculator-page__conclusion-number">
                        {{ squareStock }} см2
                    </div>
                </div>
                <div class="calculator-page__conclusion-item">
                    <div class="calculator-page__conclusion-text">
                        Объём поршневой области
                    </div>
                    <div class="calculator-page__conclusion-number">
                        {{ pistonVolume }} л
                    </div>
                </div>
                <div class="calculator-page__conclusion-item">
                    <div class="calculator-page__conclusion-text">
                        Объём штоковой области
                    </div>
                    <div class="calculator-page__conclusion-number">
                        {{ stockVolume }} л
                    </div>
                </div>
                <div class="calculator-page__conclusion-item">
                    <div class="calculator-page__conclusion-text">
                        Общий объём
                    </div>
                    <div class="calculator-page__conclusion-number">
                        {{ sumVolume }} л
                    </div>
                </div>
                <div class="calculator-page__conclusion-item">
                    <div class="calculator-page__conclusion-text">
                        Время выдвижения (диф.)
                    </div>
                    <div class="calculator-page__conclusion-number">
                        {{ extensionTimeDiff }} c
                    </div>
                </div>
                <div class="calculator-page__conclusion-item">
                    <div class="calculator-page__conclusion-text">
                        Скорость выдвижения (диф.)
                    </div>
                    <div class="calculator-page__conclusion-number">
                        {{ extensionSpeedDiff }} см/c
                    </div>
                </div>
                <div class="calculator-page__conclusion-item">
                    <div class="calculator-page__conclusion-text">
                        Время обратного хода
                    </div>
                    <div class="calculator-page__conclusion-number">
                        {{ returnTime }} c
                    </div>
                </div>
                <div class="calculator-page__conclusion-item">
                    <div class="calculator-page__conclusion-text">
                        Усилие обратного хода
                    </div>
                    <div class="calculator-page__conclusion-number">
                        {{ reverseReinforcement }} кг
                    </div>
                </div>
            </div>
            <div class="calculator-page__summ">
                Расчётная мощность привода: {{ ratedDrivePower }} кВт
                <div v-if="dataC[0]" class="calculator-page__select">
                    <template>
                        <el-select
                                v-model="selected"
                                placeholder="Выберите категорию"
                        >
                            <el-option
                                    v-for="(item, index) in dataC"
                                    :key="item.alias + item.name"
                                    :label="item.name"
                                    :value = "{
                                        name: index,
                                        alias: item.alias,
                                        volume_filters: item.volume_filters,
                                        pressure_filters: item.pressure_filters
                                    }"
                            />
                        </el-select>
                    </template>

<!--                    <select v-model="selected">-->
<!--                        <option disabled value="">Выберите категорию</option>-->
<!--                        <option v-for="(item, index) in categories"-->
<!--                                v-bind:value="{-->
<!--                            name: index,-->
<!--                            alias: item.alias,-->
<!--                            volume_filters: item.volume_filters,-->
<!--                            pressure_filters: item.pressure_filters-->
<!--                        }">-->
<!--                            {{ item.name }}-->
<!--                        </option>-->
<!--                    </select>-->
                    <button :disabled=isDisabled v-on:click="getFilteredProducts">Выбрать товары</button>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                diameter_piston: '',
                diameter_stock: '',
                stroke_length: '',
                oil_consumption: '',
                extension_time: '',
                pressure: '',
                extension_force: '',
                hideWarningText: true,
                selected: '',
                dataC: []
            }
        },
        mounted() {
            this.dataC = JSON.parse(categories);
        },
        computed: {
            squarePiston: function () {
                this.hideWarningText = !!this.diameter_piston && !!this.diameter_stock && (+this.diameter_stock > +this.diameter_piston);

                if (!!this.diameter_piston)
                    return (Math.PI * (Math.pow((+this.diameter_piston / 2), 2) / 100)).toFixed(2);
                else
                    return 0
            },
            squareStock: function () {
                this.hideWarningText = !!this.diameter_piston && !!this.diameter_stock && (+this.diameter_stock > +this.diameter_piston);

                if (!!this.diameter_stock && !!this.diameter_piston && (+this.diameter_stock < +this.diameter_piston))
                    return (+this.squarePiston - (Math.PI * (Math.pow((+this.diameter_stock / 2), 2) / 100))).toFixed(2);
                else
                    return 0
            },
            pistonVolume: function () {
                if (!!this.squarePiston && !!this.stroke_length)
                    return ((+this.squarePiston * +this.stroke_length) / 10000).toFixed(2);
                else
                    return 0
            },
            stockVolume: function () {
                if (!!this.squareStock && !!this.stroke_length)
                    return ((+this.squareStock * +this.stroke_length) / 10000).toFixed(2);
                else
                    return 0
            },
            sumVolume: function () {
                if (!!this.pistonVolume && !!this.stockVolume)
                    return (+this.pistonVolume + +this.stockVolume).toFixed(2);
                else
                    return 0
            },
            extensionTimeDiff: function () {
                if (!!this.pistonVolume && !!(+this.oil_consumption))
                    return (((+this.pistonVolume - +this.stockVolume) / +this.oil_consumption) * 60).toFixed(2);
                else
                    return 0
            },
            extensionSpeedDiff: function () {
                if (!!this.stroke_length && !!(+this.extensionTimeDiff)) {
                    return ((+this.stroke_length / +this.extensionTimeDiff) / 10).toFixed(2);
                } else {
                    return 0
                }
            },
            returnTime: function () {
                if (!!this.stockVolume && !!(+this.oil_consumption))
                    return ((+this.stockVolume / +this.oil_consumption) * 60).toFixed(2);
                else
                    return 0
            },
            reverseReinforcement: function () {
                if (!!this.pressure && !!this.squareStock)
                    return (+this.pressure * +this.squareStock).toFixed(2);
                else
                    return 0
            },
            extensionSpeed: function () {
                if (!!this.stroke_length && !!(+this.extension_time))
                    return ((+this.stroke_length / +this.extension_time) / 10).toFixed(2);
                else
                    return 0

            },
            ratedDrivePower: function () {
                if (!!this.oil_consumption && !!this.pressure)
                    return (+this.oil_consumption * +this.pressure / 520).toFixed(2);
                else
                    return 0
            },
            isDisabled() {
                return !this.pressure || !(+this.oil_consumption);
            }
        },
        methods: {
            changePressure: function () {
                if (!!this.squarePiston && +this.squarePiston !== 0)
                    this.extension_force = (+this.pressure * +this.squarePiston).toFixed(2);
            },
            changeExtensionForce: function () {
                if (!!this.squarePiston && +this.squarePiston !== 0)
                    this.pressure = (+this.extension_force / +this.squarePiston).toFixed(2);
            },
            changeOilConsumption: function () {
                if (!!this.pistonVolume && !!this.oil_consumption && (+this.oil_consumption !== 0))
                    this.extension_time = ((+this.pistonVolume / +this.oil_consumption) * 60).toFixed(2);
            },
            changeDiameterPiston: function () {
                if (!!this.pressure && !!this.squarePiston)
                    this.extension_force = (+this.pressure * +this.squarePiston).toFixed(2);
                else if (!!this.pistonVolume && !!this.oil_consumption && (+this.oil_consumption !== 0))
                    this.extension_time = ((+this.pistonVolume / +this.oil_consumption) * 60).toFixed(2);
            },
            changeExtensionTime: function () {
                if (!!this.extension_time && !!this.pistonVolume && (+this.extension_time !== 0))
                    this.oil_consumption = (+this.pistonVolume / (+this.extension_time / 60)).toFixed(2);
            },
            getFilteredProducts() {
                var filters = '';
                if(!!(+this.oil_consumption) && (+this.oil_consumption !== 0)) {
                    let consumption = +this.oil_consumption / 1.5;
                    let max = (+consumption + +consumption * 0.15).toFixed(2);
                    let min = (+consumption - +consumption * 0.15).toFixed(2);
                    for(let index in this.selected.volume_filters) {
                        console.log('pressure filters: ', this.selected.volume_filters[index]);
                        filters += '/' + this.selected.volume_filters[index] + '=' + min + ',' + max;
                    }
                }

                if(!!this.pressure) {
                    for(let index in this.selected.pressure_filters) {
                        console.log(this.selected.pressure_filters[index]);
                        filters += '/' + this.selected.pressure_filters[index] + '=' + (+this.pressure);
                    }
                }
                window.open(
                    this.selected.alias + filters,
                    '_blank'
                );
            }
        },
    }
</script>

<style>
    .red {
        color: red;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
    }
</style>
