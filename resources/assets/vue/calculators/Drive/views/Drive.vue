<template>
    <div class="calculator-page__inner">
        <div class="calculator-page__input">
            <div class="calculator-page__input-title">
                Привод
            </div>
            <div class="calculator-page__input-text">
                Введите параметры вашего <br> привода:
            </div>
            <div class="calculator-page__input-item">
                <label for="working_volume" class="calculator-page__label">Рабочий объем</label>
                <div>
                    <input id="working_volume" type="number" min="0" v-model="working_volume"
                           @change="changeWorkingVolume"/>
                    <span>см3</span>
                </div>
            </div>
            <div class="calculator-page__input-item">
                <label for="pump_feed" class="calculator-page__label">Подача насоса</label>
                <div>
                    <input id="pump_feed" type="number" min="0" v-model="pump_feed"
                           @change="changePumpFeed"/>
                    <span>л/мин</span>
                </div>
            </div>
            <div class="calculator-page__input-item">
                <label for="engine_speed">Обороты двигателя</label>
                <div>
                    <input id="engine_speed" type="number" min="0" list="engineValues" v-model="engine_speed"
                           @change="changeEngineSpeed"/>
                    <datalist id="engineValues">
                        <option v-for="engineValue in engineValues">
                            {{ engineValue }}
                        </option>
                    </datalist>
                </div>
            </div>
            <div class="calculator-page__input-item">
                <label for="pressure">Давление</label>
                <div>
                    <input id="pressure" type="number" min="0" v-model="pressure"/>
                    <span>бар</span>
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
                        Мощность привода
                    </div>
                    <div class="calculator-page__conclusion-number">
                        {{ drivePower }} кВт
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                working_volume: '',
                pump_feed: '',
                pressure: '',
                engine_speed: 1500,
                engineValues: [
                    100,
                    750,
                    1500,
                    3000
                ]
            }
        },
        computed: {
            drivePower: function () {
                if (!!this.pump_feed && !!this.pressure)
                    return (+this.pump_feed * +this.pressure / 520).toFixed(2);
                else
                    return 0
            },
        },
        methods: {
            changeWorkingVolume: function () {
                if (!!this.engine_speed && !!this.working_volume)
                    this.pump_feed = (+this.engine_speed * +this.working_volume / 1000).toFixed(2);
            },
            changePumpFeed: function () {
                if (!!this.pump_feed && !!this.engine_speed && (+this.engine_speed !== 0))
                    this.working_volume = (1000 * +this.pump_feed / +this.engine_speed).toFixed(2);
            },
            changeEngineSpeed: function () {
                if (!!this.pump_feed && !!this.engine_speed && (+this.engine_speed !== 0))
                    this.working_volume = (1000 * +this.pump_feed / +this.engine_speed).toFixed(2);

                if (!!this.engine_speed && !!this.working_volume)
                    this.pump_feed = (+this.engine_speed * +this.working_volume / 1000).toFixed(2);
            }
        },
    }
</script>
