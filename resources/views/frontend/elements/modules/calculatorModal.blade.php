<div id="js_modal_calculator" class="modal-calculator__container" style="display:none">
    <form id="geometryform" name="geometry" class="calculator">
        <div class="tab-area">
            <ul class="tab-navigation flex-wrap">
                <li><a href="#cube" class="active"> <img src="/assets/frontend/images/elements/icon-cube.svg"
                                                         alt=""></a>
                </li>
                <li><a href="#sphere"> <img src="/assets/frontend/images/elements/icon-sphere.svg" alt=""></a></li>
                <li><a href="#cylinder"> <img src="/assets/frontend/images/elements/icon-cylinder.svg" alt=""></a></li>
                <li><a href="#cone"> <img src="/assets/frontend/images/elements/icon-cone.svg" alt=""></a></li>
            </ul>
            <div class="tab-container">
                <div id="cube" style="display: block;" class="tab-box active">
                    <div class="ttl">Объем и площадь поверхности (куб)</div>
                    <div class="flex-wrap">
                        <div class="geo-calc">
                            <div class="form-group">
                                <label for="cube-l">Длина (л)</label>
                                <div class="flex-wrap">
                                    <div class="form-child">
                                        <input type="number" step="any" id="cube-l" name="cube-l">
                                    </div>
                                    <div class="form-child">
                                        <select id="cube-l-uom" class="sort-select" name="cube-l-uom">
                                            <option value="1" data-uom="in">дюймов (дюйм)</option>
                                            <option value="0.08333" data-uom="футов">Фут (фут)</option>
                                            <option value="25.4" data-uom="мм">миллиметры (мм)</option>
                                            <option value="2.54" data-uom="см">сантиметры (см)</option>
                                            <option value="0.0254" data-uom="м">метры (м)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cube-w">Ширина (w)</label>
                                <div class="flex-wrap">
                                    <div class="form-child">
                                        <input type="number" step="any" id="cube-w" name="cube-w">
                                    </div>
                                    <div class="form-child">
                                        <select id="cube-w-uom" class="sort-select" name="cube-w-uom">
                                            <option value="1" data-uom="in">дюймов (дюйм)</option>
                                            <option value="0.08333" data-uom="футов">Фут (фут)</option>
                                            <option value="25.4" data-uom="мм">миллиметры (мм)</option>
                                            <option value="2.54" data-uom="см">сантиметры (см)</option>
                                            <option value="0.0254" data-uom="м">метры (м)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cube-h">Высота (h)</label>
                                <div class="flex-wrap">
                                    <div class="form-child">
                                        <input type="number" step="any" id="cube-h" name="cube-h">
                                    </div>
                                    <div class="form-child">
                                        <select id="cube-h-uom" class="sort-select" name="cube-h-uom">
                                            <option value="1" data-uom="in">дюймов (дюйм)</option>
                                            <option value="0.08333" data-uom="футов">Фут (фут)</option>
                                            <option value="25.4" data-uom="мм">миллиметры (мм)</option>
                                            <option value="2.54" data-uom="см">сантиметры (см)</option>
                                            <option value="0.0254" data-uom="м">метры (м)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cube-vol-results-uom">Показать объем как</label>
                                <div class="flex-wrap">
                                    <div class="form-child form-child__width">
                                        <select id="cube-vol-results-uom" class="sort-select"
                                                name="cube-volresults-uom">
                                            <option value="1" data-uom="дюйм³">Кубические дюймы (дюйм³)</option>
                                            <option value="0.5541" data-uom="унций">Жидкие унции (fl.oz.)</option>
                                            <option value="0.06926" data-uom="C">Cups (C)</option>
                                            <option value="0.0005787" data-uom="фут³">Кубические футы (фут³)</option>
                                            <option value="16.39" data-uom="см³">Кубические сантиметры (см³)</option>
                                            <option value="16.39" data-uom="мл">миллиметры (мл)</option>
                                            <option value="0.01639" data-uom="л">Литры (л)</option>
                                            <option value="0.00001639" data-uom="м³">Кубические метры (м³)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cube-area-results-uom">Показать площадь поверхности как</label>
                                <div class="flex-wrap">
                                    <div class="form-child form-child__width">
                                        <select id="cube-area-results-uom" class="sort-select"
                                                name="cube-area-results-uom">
                                            <option value="1" data-uom="дюйм²">Квадратные дюймы (дюйм²)</option>
                                            <option value="0.006944" data-uom="фут²">Квадратные футы (фут²)</option>
                                            <option value="645.2" data-uom="мм²">Квадратные миллиметры (мм²)</option>
                                            <option value="6.452" data-uom="см²">Квадратные сантиметры (см²)</option>
                                            <option value="0.0006452" data-uom="м²">Квадратные метры (м²)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button id="cube-btn" class="main-btn main-btn--dark-blue submit">Подсчитать</button>
                            <div id="cube-errors" class="err-area" style="opacity: 0;"></div>
                        </div>
                        <div class="geo-img">
                            <img src="/assets/frontend/images/image16.png" alt="">
                        </div>
                    </div>
                    <div class="res-area flex-wrap">
                        <div class="geo-result">Объем
                            <span id="cube-vol" class="volume" style="opacity: 1;"></span>
                        </div>
                        <div class="geo-result">Площадь
                            <span id="cube-area" class="volume" style="opacity: 1;"></span>
                        </div>
                    </div>
                </div>
                <div id="sphere" class="tab-box">
                    <div class="ttl">Объем и площадь поверхности (сфера)</div>
                    <div class="flex-wrap">
                        <div class="geo-calc">
                            <div class="form-group">
                                <label for="sphere-r">Радиус (r)</label>
                                <div class="flex-wrap">
                                    <div class="form-child">
                                        <input type="number" step="any" id="sphere-r" name="sphere-r">
                                    </div>
                                    <div class="form-child">
                                        <select id="sphere-r-uom" class="sort-select" name="sphere-r-uom">
                                            <option value="1" data-uom="in">дюймов (дюйм)</option>
                                            <option value="0.08333" data-uom="футов">Фут (фут)</option>
                                            <option value="25.4" data-uom="мм">миллиметры (мм)</option>
                                            <option value="2.54" data-uom="см">сантиметры (см)</option>
                                            <option value="0.0254" data-uom="м">метры (м)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sphere-vol-results-uom">Показать объем как</label>
                                <div class="flex-wrap">
                                    <div class="form-child form-child__width">
                                        <select id="sphere-vol-results-uom" class="sort-select"
                                                name="sphere-volresults-uom">
                                            <option value="1" data-uom="дюйм³">Кубические дюймы (дюйм³)</option>
                                            <option value="0.5541" data-uom="унций">Жидкие унции (fl.oz.)</option>
                                            <option value="0.06926" data-uom="C">Cups (C)</option>
                                            <option value="0.0005787" data-uom="фут³">Кубические футы (фут³)</option>
                                            <option value="16.39" data-uom="см³">Кубические сантиметры (см³)</option>
                                            <option value="16.39" data-uom="мл">миллиметры (мл)</option>
                                            <option value="0.01639" data-uom="л">Литры (л)</option>
                                            <option value="0.00001639" data-uom="м³">Кубические метры (м³)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sphere-area-results-uom">Показать площадь поверхности как</label>
                                <div class="flex-wrap">
                                    <div class="form-child form-child__width">
                                        <select id="sphere-area-results-uom" class="sort-select"
                                                name="sphere-area-results-uom">
                                            <option value="1" data-uom="дюйм²">Квадратные дюймы (дюйм²)</option>
                                            <option value="0.006944" data-uom="фут²">Квадратные футы (фут²)</option>
                                            <option value="645.2" data-uom="мм²">Квадратные миллиметры (мм²)</option>
                                            <option value="6.452" data-uom="см²">Квадратные сантиметры (см²)</option>
                                            <option value="0.0006452" data-uom="м²">Квадратные метры (м²)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button id="sphere-btn" class="main-btn main-btn--dark-blue submit">Подсчитать</button>
                            <div id="sphere-errors" class="err-area" style="opacity: 0;"></div>
                        </div>
                        <div class="geo-img">
                            <img src="/assets/frontend/images/image15.png" alt="">
                        </div>
                    </div>
                    <div class="res-area flex-wrap">
                        <div class="geo-result">Объем
                            <span id="sphere-vol" class="volume"></span>
                        </div>
                        <div class="geo-result">Площадь
                            <span id="sphere-area" class="volume"></span>
                        </div>
                    </div>
                </div>
                <div id="cylinder" class="tab-box">
                    <div class="ttl">Объем и площадь поверхности (цилиндра)</div>
                    <div class="flex-wrap">
                        <div class="geo-calc">
                            <div class="form-group">
                                <label for="cylinder-r">Радиус (r)</label>
                                <div class="flex-wrap">
                                    <div class="form-child">
                                        <input type="number" step="any" id="cylinder-r" name="cylinder-r" size="6">
                                    </div>
                                    <div class="form-child">
                                        <select id="cylinder-r-uom" class="sort-select" name="cylinder-r-uom">
                                            <option value="1" data-uom="in">дюймов (дюйм)</option>
                                            <option value="0.08333" data-uom="футов">Фут (фут)</option>
                                            <option value="25.4" data-uom="мм">миллиметры (мм)</option>
                                            <option value="2.54" data-uom="см">сантиметры (см)</option>
                                            <option value="0.0254" data-uom="м">метры (м)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cylinder-h">Высота (h)</label>
                                <div class="flex-wrap">
                                    <div class="form-child">
                                        <input type="number" step="any" id="cylinder-h" name="cylinder-h" size="6">
                                    </div>
                                    <div class="form-child">
                                        <select id="cylinder-h-uom" class="sort-select" name="cylinder-h-uom">
                                            <option value="1" data-uom="in">дюймов (дюйм)</option>
                                            <option value="0.08333" data-uom="футов">Фут (фут)</option>
                                            <option value="25.4" data-uom="мм">миллиметры (мм)</option>
                                            <option value="2.54" data-uom="см">сантиметры (см)</option>
                                            <option value="0.0254" data-uom="м">метры (м)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cylinder-vol-results-uom">Показать объем как</label>
                                <div class="flex-wrap">
                                    <div class="form-child form-child__width">
                                        <select id="cylinder-vol-results-uom" class="sort-select"
                                                name="cylinder-volresults-uom">
                                            <option value="1" data-uom="дюйм³">Кубические дюймы (дюйм³)</option>
                                            <option value="0.5541" data-uom="унций">Жидкие унции (fl.oz.)</option>
                                            <option value="0.06926" data-uom="C">Cups (C)</option>
                                            <option value="0.0005787" data-uom="фут³">Кубические футы (фут³)</option>
                                            <option value="16.39" data-uom="см³">Кубические сантиметры (см³)</option>
                                            <option value="16.39" data-uom="мл">миллиметры (мл)</option>
                                            <option value="0.01639" data-uom="л">Литры (л)</option>
                                            <option value="0.00001639" data-uom="м³">Кубические метры (м³)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cylinder-area-results-uom">Показать объем как</label>
                                <div class="flex-wrap">
                                    <div class="form-child form-child__width">
                                        <select id="cylinder-area-results-uom" class="sort-select"
                                                name="cylinder-area-results-uom">
                                            <option value="1" data-uom="дюйм²">Квадратные дюймы (дюйм²)</option>
                                            <option value="0.006944" data-uom="фут²">Квадратные футы (фут²)</option>
                                            <option value="645.2" data-uom="мм²">Квадратные миллиметры (мм²)</option>
                                            <option value="6.452" data-uom="см²">Квадратные сантиметры (см²)</option>
                                            <option value="0.0006452" data-uom="м²">Квадратные метры (м²)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button id="cylinder-btn" class="main-btn main-btn--dark-blue submit">Подсчитать</button>
                            <div id="cylinder-errors" class="err-area" style="opacity: 0;"></div>
                        </div>
                        <div class="geo-img">
                            <img src="/assets/frontend/images/image14.png" alt="">
                        </div>
                    </div>
                    <div class="res-area flex-wrap">
                        <div class="geo-result">Объем
                            <span id="cylinder-vol" class="volume" style="opacity: 1;"></span>
                        </div>
                        <div class="geo-result">Площадь
                            <span id="cylinder-area" class="volume" style="opacity: 1;"></span>
                        </div>
                    </div>
                </div>
                <div id="cone" class="tab-box">
                    <div class="ttl">Объем и площадь поверхности (конус)</div>
                    <div class="flex-wrap">
                        <div class="geo-calc">
                            <div class="form-group">
                                <label for="cone-r">Радиус (r)</label>
                                <div class="flex-wrap">
                                    <div class="form-child">
                                        <input type="number" step="any" id="cone-r" name="cone-r" size="6">
                                    </div>
                                    <div class="form-child">
                                        <select id="cone-r-uom" class="sort-select" name="cone-r-uom">
                                            <option value="1" data-uom="in">дюймов (дюйм)</option>
                                            <option value="0.08333" data-uom="футов">Фут (фут)</option>
                                            <option value="25.4" data-uom="мм">миллиметры (мм)</option>
                                            <option value="2.54" data-uom="см">сантиметры (см)</option>
                                            <option value="0.0254" data-uom="м">метры (м)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cone-h">Высота (h)</label>
                                <div class="flex-wrap">
                                    <div class="form-child">
                                        <input type="number" step="any" id="cone-h" name="cone-h" size="6">
                                    </div>
                                    <div class="form-child">
                                        <select id="cone-h-uom" class="sort-select" name="cone-h-uom">
                                            <option value="1" data-uom="in">дюймов (дюйм)</option>
                                            <option value="0.08333" data-uom="футов">Фут (фут)</option>
                                            <option value="25.4" data-uom="мм">миллиметры (мм)</option>
                                            <option value="2.54" data-uom="см">сантиметры (см)</option>
                                            <option value="0.0254" data-uom="м">метры (м)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cone-vol-results-uom">Показать объем как</label>
                                <div class="flex-wrap">
                                    <div class="form-child form-child__width">
                                        <select id="cone-vol-results-uom" class="sort-select"
                                                name="cone-volresults-uom">
                                            <option value="1" data-uom="дюйм³">Кубические дюймы (дюйм³)</option>
                                            <option value="0.5541" data-uom="унций">Жидкие унции (fl.oz.)</option>
                                            <option value="0.06926" data-uom="C">Cups (C)</option>
                                            <option value="0.0005787" data-uom="фут³">Кубические футы (фут³)</option>
                                            <option value="16.39" data-uom="см³">Кубические сантиметры (см³)</option>
                                            <option value="16.39" data-uom="мл">миллиметры (мл)</option>
                                            <option value="0.01639" data-uom="л">Литры (л)</option>
                                            <option value="0.00001639" data-uom="м³">Кубические метры (м³)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cone-area-results-uom">Показать объем как</label>
                                <div class="flex-wrap">
                                    <div class="form-child form-child__width">
                                        <select id="cone-area-results-uom" class="sort-select"
                                                name="cone-area-results-uom">
                                            <option value="1" data-uom="дюйм²">Квадратные дюймы (дюйм²)</option>
                                            <option value="0.006944" data-uom="фут²">Квадратные футы (фут²)</option>
                                            <option value="645.2" data-uom="мм²">Квадратные миллиметры (мм²)</option>
                                            <option value="6.452" data-uom="см²">Квадратные сантиметры (см²)</option>
                                            <option value="0.0006452" data-uom="м²">Квадратные метры (м²)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button id="cone-btn" class="main-btn main-btn--dark-blue submit">Подсчитать</button>
                            <div id="cone-errors" class="err-area" style="opacity: 0;"></div>
                        </div>
                        <div class="geo-img">
                            <img src="/assets/frontend/images/image17.png" alt="">
                        </div>
                    </div>
                    <div class="res-area flex-wrap">
                        <div class="geo-result">Объем
                            <span id="cone-vol" class="volume" style="opacity: 1;"></span>
                        </div>
                        <div class="geo-result">Площадь
                            <span id="cone-area" class="volume" style="opacity: 1;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>




















