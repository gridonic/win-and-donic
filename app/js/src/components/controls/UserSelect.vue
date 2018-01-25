<template>
    <div>
        <select
            class="uk-select"
            v-model="selected">
            <option
                v-for="player in players"
                :key="player.id"
                :value="player"> <!-- v-bind:value="option.value"> -->
                {{ player.username }}
            </option>
        </select>
        <span>Selected: {{ selected ? selected.username : null }}</span>
    </div>
</template>

<script>
import User from '@/entity/User';

export default {
    name: 'UserSelect',
    props: {
        value: {
            type: User,
            default: null
        }
    },
    data() {
        return {
            selected: this.value
        };
    },
    computed: {
        players() {
            return this.$store.state.players;
        }
    },
    watch: {
        selected() {
            this.$emit('input', this.selected);
        }
    }
};
</script>

<style scoped>
</style>
