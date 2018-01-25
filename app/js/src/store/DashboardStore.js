export const Mutations = {
    UPDATE_PLAYERS: 'updatePlayers'
};

export const Actions = {
    LOAD_PLAYERS: 'loadPlayers'
};

export default class DashboardStore {
    constructor({ userLoaderService }) {
        this.userLoaderService = userLoaderService;
    }

    get state() {
        return {
            players: []
        };
    }

    get getters() {
        return {
            players: state => state.players
        };
    }

    get mutations() {
        return {
            updatePlayers(state, players) {
                state.players = players;
            }
        };
    }

    get actions() {
        const self = this;

        return {
            async loadPlayers({ commit }) {
                commit(
                    Mutations.UPDATE_PLAYERS,
                    await self.userLoaderService.loadAllUsersAsync());
            }
        };
    }
}
