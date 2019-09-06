<template>
	<div class="options-overview form-items">
		<p v-for="attribute in attributes" class="options-overview__option" :class="attribute.state">{{ attribute.name }}</p>
        <!-- <p class="options-overview__option is_done">Model</p>
        <p class="options-overview__option is_done">Neck Construction</p>
        <p class="options-overview__option is_active">Body Wood</p>
        <p class="options-overview__option">Top Wood</p>
        <p class="options-overview__option">Binding (Optional)</p>
        <p class="options-overview__option">Neck Wood</p>
        <p class="options-overview__option">Fingerboard</p>
        <p class="options-overview__option">Scale Length</p>
        <p class="options-overview__option">Frets</p>
        <p class="options-overview__option">Fret Marker</p>
        <p class="options-overview__option">12<sup>th</sup> Fret Inlay</p>
        <p class="options-overview__option">Hardware Color</p>
        <p class="options-overview__option">Bridge</p>
        <p class="options-overview__option">Tuners</p>
        <p class="options-overview__option">Pick Ups</p> -->
    </div>
</template>

<script>
    export default {
    	data(){
            return {
            	current_attr_index: 0,
                attributes: [
                	{
                		name: 'Model',
                		state: 'is_done'
                	},
                	{
                		name: 'Neck Construction',
                		state: 'is_done'
                	},
                	{
                		name: 'Body Wood',
                		state: 'is_active'
                	},
                	{
                		name: 'Top Wood',
                		state: ''
                	},
                	{
                		name: 'Binding (Optional)',
                		state: ''
                	}
                ]
            };
        }
    };
</script>