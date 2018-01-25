export default class DashboardStore {
    constructor({ userLoaderService }) {
        this.userLoaderService = userLoaderService;
    }

    get state() {
        return {
            players: []
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
                commit('updatePlayers', await self.userLoaderService.loadAllUsersAsync());
            }
        };
    }
}
