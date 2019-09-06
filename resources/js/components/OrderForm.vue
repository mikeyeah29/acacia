<template>
    <div class="main_section">
        <hero-header title="Custom Order~Form"></hero-header>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <options-overview :current_attr_index="current_attr_index"></options-overview>
                </div>
                <div class="col-sm-12 col-md-7">
                    <h1>Body Wood</h1>

                    <div class="option-list">
                        <div class="option-box">
                            <img src="img/alder.jpg">
                            <div class="d-flex justify-content-between align-items-center option-box__title">
                                <p class="option-box__name">Alder</p>
                                <div class="option-box__circle"></div>
                            </div>
                        </div>
                        <div class="option-box">
                            <img src="img/mahogany.jpg">
                            <div class="d-flex justify-content-between align-items-center option-box__title">
                                <p class="option-box__name">Mahogany</p>
                                <div class="option-box__circle"></div>
                            </div>
                        </div>
                        <div class="option-box selected">
                            <img src="img/swamp_ash.jpg">
                            <div class="d-flex justify-content-between align-items-center option-box__title">
                                <p class="option-box__name">Swamp Ash</p>
                                <div class="option-box__circle"></div>
                            </div>
                        </div>
                        <div class="option-box">
                            <img src="img/sapele.jpg">
                            <div class="d-flex justify-content-between align-items-center option-box__title">
                                <p class="option-box__name">Sapele</p>
                                <div class="option-box__circle"></div>
                            </div>
                        </div>
                        <div class="option-box">
                            <img src="img/black_limba.jpg">
                            <div class="d-flex justify-content-between align-items-center option-box__title">
                                <p class="option-box__name">Black Limba</p>
                                <div class="option-box__circle"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-nav-btns">
                        <div class="btn btn-grey btn-prev">Back</div>
                        <div class="btn btn-next">Next</div>
                    </div>

                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="price-panel">
                        <h2>Price</h2>
                        <p>${{ this.price }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import HeroHeader from './hero-header.vue';
    import OptionsOverview from './options-overview.vue';
    export default {
        components: { HeroHeader, OptionsOverview },
        data(){
            return {
                current_attr_index: 0,
                price: 0
            };
        }
    };
</script>
