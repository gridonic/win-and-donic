<template>
    <div>
        <select class="uk-select"
                v-model="selected">
            <option v-for="player in players"> <!-- v-bind:value="option.value"> -->
                {{ player }}
            </option>
        </select>
        <span>Selected: {{ selected }}</span>
    </div>
</template>

<script>
    export default {
        name: 'user-select',
        props: ['value'],
        data() {
            return {
                players: ['julez', 'bidu', 'peschee'],
                selected: null,
            };
        },
        created: function created() {
            this.selected = this.value;
        },
        watch: {
            selected: function selected() {
                this.$emit('input', this.selected);
            },
        },
    };
</script>

<style scoped>
</style>
