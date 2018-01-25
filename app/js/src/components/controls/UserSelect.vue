<template>
    <div>
        <select
            class="uk-select"
            v-model="selected">
            <option
                v-for="player in players"
                :key="player.id" :value="player">

                {{ player.username }}
            </option>
        </select>
        <span>Selected: {{ selected ? selected.username : null }}</span>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
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
        ...mapGetters([
            'players'
        ])
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
