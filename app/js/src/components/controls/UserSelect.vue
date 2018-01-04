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
                players: this.$store.state.players,
                selected: this.value,
            };
        },
        watch: {
            selected() {
                this.$emit('input', this.selected);
            },
        },
    };
</script>

<style scoped>
</style>
